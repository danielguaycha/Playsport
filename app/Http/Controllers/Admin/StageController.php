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

        return view('admin.stages.edit', [
            'stage'=> $s,
            'groups'=> $g,
            'stats'=> $stats
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

    public function create(Request $request)
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

    public function store(Request $request)
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

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
