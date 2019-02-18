<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Sport;
use App\Stage;
use App\StageControl;
use App\Team;
use App\TimeTable;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Facade as Avatar;

class StageController extends Controller
{

    public function result($stage){
        $s = Stage::join('time_tables as tt', 'stages.id', 'tt.stage_id')
            ->join('teams as a', 'a.id', 'tt.team_id_a')
            ->join('teams as b', 'b.id', 'tt.team_id_b')
            ->select('tt.*','stages.name as stage', 'stages.parent', 'stages.id as stage_id', 'stages.tournament_id',
                'a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                'b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b')
            ->where('stages.id', $stage)
            ->get();

        $g = Group::where('tournament_id', $s[0]->tournament_id)->get();

        $stats = Group::join('team_groups','team_groups.group_id', 'groups.id')
            ->join('teams', 'teams.id', 'team_groups.team_id')
            ->select('teams.name as team', 'teams.id as team_id','groups.id as group_id','team_groups.*')
            ->selectRaw('team_groups.gf - team_groups.gc as gd')
            ->where('groups.tournament_id', $s[0]->tournament_id)
            ->orderBy('team_groups.pts', 'desc')
            ->orderBy('gd', 'desc')
            ->get();

        $teams = Team::where('tournament_id', $s[0]->tournament_id)->get();


        return view('admin.stages.edit', [
            'stage'=> $s,
            'groups'=> $g,
            'stats'=> $stats,
            'teams'=> $teams
        ]);
    }

    public function change_result(Request $request){
        //dd($request);
        $tt = TimeTable::find($request->time_table_id);
        if (($tt->count())==0) abort(404);
        switch ($request->btn_set){
            case 'revert_one':
                $sc = StageControl::where([
                    ['time_table_id', $tt->id],
                    ['team', $request->team]
                ])->orderBy('id', 'desc')->first();

                if (($sc!=null)) {
                    if ($request->team == 'team_a') {
                        $tt->team_id_a = $sc->team_old;
                    } elseif ($request->team == 'team_b') {
                        $tt->team_id_b = $sc->team_old;
                    }
                    $tt->save();
                    $sc->delete();
                    session()->flash("info", "Cambios revertidos");
                }else{
                    session()->flash("warning", "No hay cambios revertidos");
                }
                break;
            case 'revert_all':

                break;
            case 'update':
                $sc = new StageControl();
                $sc->team_old = $request->team_old;
                $sc->team_new = $request->team_new;
                $sc->time_table_id = $request->time_table_id;
                $sc->team = $request->team;
                $sc->save();

                if ($request->team == 'team_a'){
                    $tt->team_id_a = $request->team_new;
                }elseif ($request->team == 'team_b'){
                    $tt->team_id_b = $request->team_new;
                }

                $tt->save();

                session()->flash("success", "Actualizado con exito");

                break;
        }
        return back();
    }

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        //
    }

    public function create(Request $request){

        # Verificación del Torneo
        if (!$request->query('tournament'))
            abort(404);
        $t = Tournament::find($request->query('tournament'));
        if(!$t)
            abort(404);

        $stages = Stage::where([
            ['tournament_id', $t->id],
            ['parent', 0]
        ])->count();

        if($stages>0) {
            session()->flash('warning','Ya has creado una eliminatoria');
            return back();
        }
        # Verificación del tipo
        if($request->query('type')){
            $num = intval($request->query('type'));
            if(!$num)
                return back();

            $teams = Team::where([
                ['tournament_id', $t->id],
                ['status', '<>', -1]
            ])->get();


            return view('admin.tournament.stages.stage',[
                'tournament'=> $t,
                'teams'=> $teams,
                'num'=> ($num*2)
            ]);
        }


        return view('admin.tournament.stages.stage', [
            'tournament'=> $t
        ]);

    }

    public function create2(Request $request)
    {
        if(!$request->query('tournament')) {
            $t = Tournament::where([
                ['status', 1],
                ['organizations_id', Auth::user()->organization_id]
            ])->get();
            return view('admin.stages.create', [
                'tournaments' => $t
            ]);
        }else{

            $t = Tournament::find($request->query('tournament'));

            if (($t->count())<=0)
                abort(404);

            /*$g = Group::where("tournament_id", $t->id)->get();
            if (count($g)>0){
                session()->flash("info", "Existen grupos creados para este torneo");
                return back();
            }*/

            $sport = Sport::find($t->sports_id);
            $teams = Team::where([
                ['sport_id', $t->sports_id],
                ['type', $t->type]
            ])->get();

            $stages = Stage::where('tournament_id', $t->id)->get();

            return view('admin.stages.create', [
                'tournaments' => $t,
                'sport'=>$sport,
                'teams'=> $teams,
                'stages'=>$stages
            ]);
        }
    }

    public function store2(Request $request)
    {
        if (!$request->has("name") || !$request->has("tournament_id") || !$request->has("match_num")){
            session()->flash("warning", "El nombre, número de encuentros  y torneo son obligatorios");
            return back();
        }

        $st = new Stage();
        $st->name = $request->name;
        $st->match_num = $request->match_num;
        $st->desc = $request->desc;
        $st->tournament_id = $request->tournament_id;

        if ($request->has("parent"))
            $st->parent = $request->parent;

        $st->save();
        session()->flash("success", "Etapa guardada con exito");
        return redirect(route("stage.create"));

    }

    public function store(Request $request){
        $tier = [8=>'Octavos de Final', 4=>'Cuartos de Final', 2=>'SemiFinal', 1=>'Final'];
        $team_num = count($request->to_team);
        if($request->num == $team_num){
            $vs = array();
            for ($i=1; $i<=($team_num/2); $i++){
                $vs[] = [$request->to_team[$i-1], $request->to_team[$team_num-$i]];
            }

            if(count($vs)>0){
                $last = 0; // para tomar el padre
                $i=0; // contador para validar el primer Stage
                $first = 0; // para guardar el primer Stage
                foreach ($tier as $key => $t){
                    if($key <= ($request->num/2)) {

                        $st = new Stage();
                        $st->name = $t;
                        $st->match_num = $key;
                        $st->desc = 'Etapa de ' . $t;
                        $st->tournament_id = $request->tournament_id;
                        $st->parent = $last;
                        $st->status = 0;
                        $st->save();

                        if ($i==0)
                            $first = $st->id;

                        $last = $st->id;
                        $i++;
                    }
                }

                if ($first>0){ # Guardando las fechas
                    foreach($vs as $v){
                        $tt = new TimeTable();
                        $tt->team_id_a = $v[0];
                        $tt->team_id_b = $v[1];
                        $tt->stage_id = $first;
                        $tt->save();
                    }
                }
                # semifinal
                $torneo = Tournament::find($request->tournament_id);
                if ($team_num ==4){
                    $teams_new = array();
                    for ($i=1; $i<=2; $i++){
                        $tn = new Team();
                        $tn->name = 'Ganador #'.$i;
                        $tn->tournament_id = $torneo->id;
                        $tn->type = $torneo->type;
                        $tn->sport_id = $torneo->sports_id;
                        $tn->status = -1;
                        $tn->logo= 'img/teams/'.time().'.png';

                        Avatar::create($tn->name)->setDimension(100)
                            ->save($tn->logo);
                        $tn->save();
                        $teams_new[] = $tn->id;
                    }
                    $tt = new TimeTable();
                    $tt->team_id_a = $teams_new[0];
                    $tt->team_id_b = $teams_new[1];
                    $tt->stage_id = $last;
                    $tt->save();
                }

                return redirect(route('tournament.show', ['id'=> $request->tournament_id]));
            }

        }else{
            session()->flash('warning', 'Necesitas '.$request->num.' equipos para poder crear esta eliminatoria');
            return back();
        }
    }

    public function show($tournament_id)
    {
        $stage = Stage::join('time_tables as tt', 'stages.id', 'tt.stage_id')
            ->join('teams as a', 'a.id', 'tt.team_id_a')
            ->join('teams as b', 'b.id', 'tt.team_id_b')
            ->leftJoin('results', 'results.time_table_id', 'tt.id')
            ->select('tt.*','stages.id as stage_id','stages.name as stage', 'stages.parent', 'stages.id as stage_id',
                'a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                'b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b',
                'results.result_a', 'results.result_b', 'results.penal_a', 'results.penal_b')
            ->where('stages.tournament_id', $tournament_id)
            ->orderBy('stages.parent', 'asc')
            ->orderBy('tt.hour', 'asc')
            ->get();
        return view('admin.tournament.stages.stage-show', [
            'stages'=> $stage,
            'tournament_id'=> $tournament_id
        ]);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function destroy_all($tournament_id){
        $t = Stage::where([
            ['tournament_id', $tournament_id],
        ])->delete();
        session()->flash('success', 'Eliminatoria removida con éxito');
        return back();
    }
}
