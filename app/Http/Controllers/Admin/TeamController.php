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
        if ($request->query("sport") && $request->query("type")){
            $con = [
                ['organization_id', Auth::user()->organization_id],
                ['sport_id', $request->query('sport')],
                ['type', $request->query('type')],
                ['status', 1],
            ];
        }
        elseif ($request->query('sport')){
            $con = [
                ['organization_id', Auth::user()->organization_id],
                ['sport_id', $request->query('sport')],
                ['status', 1],
            ];
        }
        elseif ($request->query("type")){
            $con = [
                ['organization_id', Auth::user()->organization_id],
                ['type', $request->query('type')],
                ['status', 1],
            ];
        }
        else{
            $con = [
                ['organization_id', Auth::user()->organization_id],
                ['status', 1],
            ];
        }

        $team = Team::where($con)->orderBy('sport_id', 'desc')->get();

        if (count($team)<=0){
            session()->flash("info", "No hay equipos!");
        }else{
            session()->remove("info");
        }

        $s = Sport::all();
        // adding players numbers
        $newTeams = array();
        foreach ($team as $t){
            $t['players'] = count(PlayerTeam::where('team_id', $t->id)->get());
            $newTeams[] = $t;
        }

        return view('admin.teams.index',[
            'Team' => $newTeams,
            'sports'=> $s
        ]);
    }

    public function create()
    {
        $sport = Sport::all();
        $t = Team::select('logo', 'alias')->distinct('alias')->get();
        return view('admin.teams.create')->with(['sports' => $sport, 'colors'=> $t]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'sport'=> 'required'
        ]);

        $team = new Team();

        $team -> name = $request->get('name');
        $team -> type = $request->get('type');
        $team -> organization_id = Auth::user()->organization_id;
        $team -> logo = $request->get('logo');
        $team->alias = $request->get("alias");
        $team -> sport_id = $request->get('sport');
        $team->status = 1;


        $team-> save();
        session()->flash("success", "Equipo guardado con exito");

        return back();
    }

    public function show($id)
    {
        $team = Team::find($id);
        if (count($team)>0) {
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
        if (count($t)>0) {
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
        $t->sport_id = $request->sport;
        $t-> logo = $request->get('logo');

        $t->save();
        session()->flash("success", "Datos actualizados con exito");
        return back();
    }


    public function destroy($id)
    {
        $t = Team::find($id);
        if (count($t)>0){

            $pt = PlayerTeam::where('team_id', $id)->get();
            $tg = TeamGroup::where("team_id", $id)->get();

            if (count($pt)>0 || count($tg)>0) {
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
