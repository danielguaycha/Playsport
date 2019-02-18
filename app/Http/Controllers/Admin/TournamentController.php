<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\Controller;
use App\Stage;
use App\Team;
use App\Tournament;
use App\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as Avatar;
use PHPUnit\Runner\Filter\GroupFilterIterator;

class TournamentController extends Controller
{
    public function index()
    {
        return view('admin.tournament.index',['tournaments'=> $this->getTournament()]);
    }

    public function process(Request $request, $id){
        if(!$request->has('opc'))
            abort(404);
        $t = Tournament::find($id);
        if(!$t)
            abort(404);

        switch ($request->get('opc')){
            case 'end':
                $t->status = 1;
                break;
            case 'active':
                $t->status = 0;
                break;
        }
        $t->save();
        session()->flash('success', 'Estado actualizado');
        return back();
    }

    public function create()
    {
        $sport = Sport::all();
        return view('admin.tournament.create')->with(['sports' => $sport]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:tournaments|max:100',
            'date_init'=> 'required',
            'date_end'=> 'required',
        ]);
        $admin = new AdminController();
        $tournament = new Tournament();

        $tournament -> name = $request->get('name');
        $tournament -> date_init = $request->get('date_init');
        $tournament -> date_end = $request->get('date_end');
        $tournament -> type = $request->get('type');
        $tournament -> url = Str::slug($tournament->name);
        $tournament -> status = 0; // En proceso
        $tournament -> rules = $request->rules;
        $tournament -> sports_id = $request->get('sport');
        $tournament->priority = $request->get('priority');
        $tournament -> organizations_id = Auth::user()->organization_id;

        if($request->file('logo'))
            $tournament->logo = $admin->uploadImage($request->file("logo"), "img/tournaments", ['width'=> 100, 'height'=>100]);
        else {
            $tournament->logo= 'img/tournaments/'.$tournament->name.'.png';
            Avatar::create($tournament->name)->setDimension(100)->save($tournament->logo);
        }
        $tournament -> save();

        session()->flash('success', 'Datos correctamente ingresados') ;
        return redirect(route('tournament.show', ['id'=> $tournament->id]));
    }

    public function show($id)
    {
        $t = Tournament::join('sports', 'tournaments.sports_id', 'sports.id')
            ->join('organizations', 'tournaments.organizations_id', 'organizations.id')
            ->where([
                ['tournaments.organizations_id', Auth::user()->organization_id],
                ['tournaments.id', $id],
                ['tournaments.id', '<>', -1]
            ])
            ->select('sports.name as sport', 'tournaments.*', 'organizations.name as organization')
            ->orderBy('tournaments.name')
            ->first();

        if(!$t){
            abort(404);
        }

        $ligue = Group::where([
            ['tournament_id', $id],
            ['class', 'league']
        ])->select('id', 'name', 'status')->get();

        $f_grupos = Group::where([
            ['tournament_id', $id],
            ['class', 'group']
        ])->select('id', 'name', 'status')->get();

        $stages = Stage::where([
            ['tournament_id', $id],
            ['parent', 0]
        ])->get();

        $teams = Team::leftJoin('player_teams', 'player_teams.team_id', 'teams.id')
            ->leftJoin('players', 'players.id', 'player_teams.player_id')
            ->select('teams.*', DB::raw('count(players.id) as number'))
            ->where([
                ['tournament_id', $id],
                ['status', '<>', -1]
            ])
            ->groupBy('teams.id')
            ->get();


        return view('admin.tournament.show', [
            'tournament'=> $t,
            'teams'=> $teams,
            'ligues'=> $ligue,
            'groups'=> $f_grupos,
            'stages'=> $stages,
        ]);
    }

    public function edit($id)
    {
        $t = Tournament::find($id);
        if(($t->count())>0) {
            $sports = Sport::all();
            return view('admin.tournament.edit', ['tournament'=> $t, 'sports'=> $sports]);
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|max:100',
            'priority'=> 'required|max:100|min:-10',
            'date_init'=> 'required',
            'date_end'=> 'required',
        ]);

        $t = Tournament::find($id);
        if ($t){
            $t->name = $request->name;
            $t->date_init = $request->date_init;
            $t->date_end = $request->date_end;
            $t->type = $request->type;
            $t-> url = Str::slug($request->url);
            $t->sports_id = $request->sport_id;
            $t->priority = $request->priority;
            $t->rules = $request->rules;

            if($request->change){
                $admin = new AdminController();
                $admin->removeImage($t->logo);
                if ($request->hasFile('logo')){
                    $t->logo = $admin->uploadImage($request->file('logo'), 'img/tournaments', ['width'=>150, 'height'=> 150]);
                }else{
                    $t->logo= 'img/tournaments/'.time().'.png';
                    Avatar::create($t->name)
                        ->save($t->logo);
                }
            }

            $t->save();

            session()->flash("success", "Registro actualizado con exito");
            return back();
        }
        abort(404);
    }

    public function destroy($id)
    {
        $t = Tournament::find($id);
        if($t){
            $t->status = -1;
            $t->save();
            session()->flash('success', 'Se eliminó el torneo con éxito');
            return back();
        }
    }

    public function getTournament(){
        return Tournament::join('sports', 'tournaments.sports_id', 'sports.id')
            ->leftJoin('teams', 'teams.tournament_id', 'tournaments.id')
            ->join('organizations', 'tournaments.organizations_id', 'organizations.id')
            ->where([
                ['tournaments.organizations_id', Auth::user()->organization_id],
                ['tournaments.status', '<>', -1]
            ])
            ->select('sports.name as sport', 'tournaments.*', 'organizations.name as organization',
                DB::raw('count(teams.id) as teams'))
            ->groupBy('tournaments.id', 'sports.name', 'organizations.name')
            ->orderBy('tournaments.status', 'asc')
            ->orderBy('tournaments.priority', 'asc')
            ->paginate(10);
    }


}
