<?php

namespace App\Http\Controllers\Admin;

use App\PlayerTeam;
use App\Sport;
use App\TeamGroup;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Team;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Facade as Avatar;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function teams_tournament_sport($tournament_id){
        $t = Tournament::find($tournament_id)->sport();
        dd($t);
        //return response()->json($t);
    }

    public function index(Request $request)
    {
        if($request->query('tournament')){
            $con = [
                ['status', 1],
                ['tournament_id', $request->query('tournament')]
            ];
        }
        else{
            $con = [
                ['status', 1],
            ];
        }

        $team = Team::where($con)->orderBy('sport_id', 'desc')->get();

        if (($team->count())<=0){
            session()->flash("info", "No hay equipos!");
        }else{
            session()->remove("info");
        }

        $s = Sport::all();
        // adding players numbers
        $newTeams = array();
        foreach ($team as $t){
            $t['players'] = (PlayerTeam::where('team_id', $t->id)->get())->count();
            $newTeams[] = $t;
        }

        $tournaments = Tournament::where([
            ['status', '<>', -1]
        ])->select('id', 'name')->orderBy('priority', 'asc')->get();

        return view('admin.teams.index',[
            'Team' => $newTeams,
            'sports'=> $s,
            'tournaments'=> $tournaments
        ]);
    }

    public function create(Request $request)
    {
        if ($request->query("tournament"))
            $tournaments = Tournament::where('id', $request->query('tournament'))->get();
        else
            $tournaments = Tournament::where('status', '<>', -1)->get();

        $sport = Sport::all();

        return view('admin.teams.create')->with([
            'sports' => $sport,
            'tournaments'=> $tournaments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'sport'=> 'required',
            'tournament_id'=> 'required',
        ]);
        $admin = new AdminController();
        $team = new Team();

        $team->name = $request->get('name');
        $team->type = $request->get('type');
        $team->tournament_id = $request->tournament_id;
        $team->alias = $request->get("alias");
        $team->color = $request->get('color');
        $team->sport_id = $request->get('sport');
        $team->status = 1;
        if($request->logo) {
            $team->logo = $admin->uploadImage($request->file('logo'), 'img/teams', ['width'=>100, 'height'=> 100]);
        }else {
            $team->logo= 'img/teams/'.time().'.png';
            if (!$request->alias)
                Avatar::create($team->name)->setDimension(100)
                    ->setBackground($team->color)
                    ->save($team->logo);
            else
                Avatar::create($team->alias)->setDimension(100)
                    ->setBackground($team->color)
                    ->save($team->logo);
        }
        $team-> save();
        session()->flash("success", "Equipo guardado con exito");

        return back();
    }

    public function show($id)
    {
        $team = Team::find($id);
        if (($team)->count()>0) {
            $pt = PlayerTeam::join('players', 'players.id', 'player_teams.player_id')
                ->where('team_id', $id)->get();

            return view('admin.teams.show', [
                'team'=> $team,
                'players'=> $pt
            ]);
        }
        abort(404);
    }

    public function edit($id)
    {
        $t = Team::find($id);
        $colors = Team::select('logo', 'alias')->distinct('alias')->get();
        $sports = Sport::all();
        if (($t->count())>0) {
            return view('admin.teams.edit', ['team'=> $t, 'sports'=> $sports, 'colors'=> $colors]);
        }

        abort(404);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'sport'=> 'required'
        ]);

        $t = Team::find($id);
        $t->name = $request->name;
        $t->alias = $request->alias;
        $t->type = $request->type;
        $t->color = $request->color;
        $t->sport_id = $request->sport;

        if($request->change){
            $admin = new AdminController();
            $admin->removeImage($t->logo);
            if ($request->hasFile('logo')){
                $t->logo = $admin->uploadImage($request->file('logo'), 'img/teams', ['width'=>100, 'height'=> 100]);
            }else{
                $t->logo= 'img/teams/'.time().'.png';
                if (!$request->alias)
                    Avatar::create($t->name)->setDimension(100)
                        ->setBackground($t->color)
                        ->save($t->logo);
                else
                    Avatar::create($t->alias)->setDimension(100)
                        ->setBackground($t->color)
                        ->save($t   ->logo);
            }
        }

        $t->save();
        session()->flash("success", "Datos actualizados con exito");
        return back();
    }


    public function destroy($id)
    {
        $t = Team::find($id);
        if (($t->count())>0){

            $pt = PlayerTeam::where('team_id', $id)->get();
            $tg = TeamGroup::where("team_id", $id)->get();

            if (($pt->count())>0 || ($tg->count())>0) {
                $t->status = 0;
                $t->save();
                session()->flash('info', "Este equipo tiene jugadores o grupos asignados, se ha cambiado el estado!");
                return back();
            }else{
                $t->delete();
                session()->flash("success", "Equipo eliminado con exito");
                return back();
            }
        }
        abort(404);
    }
}
