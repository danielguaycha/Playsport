<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Stage;
use App\Team;
use App\TeamGroup;
use App\TimeTable;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TimeTableController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }


    public function create(Request $request)
    {

        // if have tournament a group
        if ($request->query('tournament') && $request->query('group')){

            $t = Tournament::find($request->query('tournament'));
            if (($t->count())<=0)
                abort(404);

            $group = Group::find($request->query('group'));
            if (($group->count())<=0)
                abort(404);

            return($this->process_group($t, $group));
        }

        if ($request->query('tournament') && $request->query('stage')) {
            $t = Tournament::find($request->query('tournament'));
            if (($t->count())<=0)
                abort(404);

            $stage = Stage::find($request->query('stage'));
            if (($stage->count())<=0)
                abort(404);

            return($this->process_stage($t, $stage));
        }

        // steep one
        if (!$request->query("tournament")) {
            $t = Tournament::where([
                ['status', 1],
                ['organizations_id', Auth::user()->organization_id]
            ])->get();

            return view("admin.timetable.create", [
                'tournaments' => $t,
                //'stages'=> $t;
            ]);
        }
        else {
            $t = Tournament::find($request->query('tournament'));

            // steep two - Groups - if have any group then show this
            if (!$request->query('group') && !$request->query('stage')){
                $group = Group::where('tournament_id', $t->id)->get();
                $stages = Stage::where("tournament_id", $t->id)->get();
                if (($group->count()) > 0 || ($stages->count())>0) {
                    return view("admin.timetable.create", [
                        'tournament' => $t,
                        'groups' => $group,
                        'stages'=> $stages
                    ]);
                }
            }

            return view("admin.timetable.create", [
                'tournament' => $t,
                'message'=> 'No hay grupos ni etapas para este torneo'
            ]);
        }
    }

    public function store(Request $request)
    {
        if (!$request->has('type') || !$request->has("hour") || !$request->has("date")
            || !$request->has("place"))
        {
             session()->flash("info", "Fecha, lugar y hora son requeridos");
            return back();
        }

        $teams = explode(";", $request->teams);

        if (($teams->count())!=2){
            session()->flash('warning', "Necesitas escoger dos equipos!");
            return back();
        }

        $timeTable = TimeTable::whereRaw('(team_id_a=? and team_id_b=?) or (team_id_a=? or team_id_b=?)', [
            $teams[0], $teams[1], $teams[1], $teams[0]
        ])->get();

        $tt = new TimeTable();
        $tt->date = $request->date;
        $tt->hour = $request->hour;
        $tt->place = $request->place;
        $tt->status = -1; // Fecha Establecida
        $tt->group_id = $request->group;
        $tt->team_id_a = $teams[0];
        $tt->team_id_b = $teams[1];
        $tt->stage_id = null;

        session()->flash("success", "Fecha guardada con exito ".(
            (($timeTable->count())>0?", pero ya existe un encuentro para estos equipos":"")
            ));
        $tt->save();

        return back();
    }

    public function store_stage(Request $request){

        $tt_num = TimeTable::where('stage_id', $request->get('stage_id'))->get();
        if(($tt_num->count()) >= $request->get('num')){
            session()->flash("warning", "Ya has agregado dos encuentros");
            return back();
        }

        $ta = new Team();
        $ta->name = $request->get('team_a');
        $ta->alias = $request->get("team_a");
        $ta->type = $request->get('type');
        $ta->logo = '#256298';
        $ta->organization_id = Auth::user()->organization_id;
        $ta->sport_id = $request->get("sport_id");

        $tb = new Team();
        $tb->name = $request->get('team_b');
        $tb->alias = $request->get("team_b");
        $tb->type = $request->get('type');
        $tb->logo = '#256298';
        $tb->organization_id = Auth::user()->organization_id;
        $tb->sport_id = $request->get("sport_id");

        $ta->save();
        $tb->save();

        $tt = new TimeTable();
        $tt->date = $request->get('date');
        $tt->hour = $request->get('hour');
        $tt->place = $request->get('place');
        $tt->team_id_a = $ta->id;
        $tt->team_id_b = $tb->id;
        $tt->stage_id = $request->get("stage_id");
        $tt->save();

        session()->flash("success", "Calendario guardado con exito");
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id, Request $request)
    {
        $tt = null;
        if ($request->query('group_id')) {
            $tt = TimeTable::join('groups', 'groups.id', 'time_tables.group_id')
                ->join('teams as a', 'a.id', 'time_tables.team_id_a')
                ->join('teams as b', 'b.id', 'time_tables.team_id_b')
                ->join('tournaments', 'tournaments.id', 'groups.tournament_id')
                ->where('time_tables.id', $id)
                ->select('time_tables.*', 'groups.name as title',
                    'a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                    'b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b',
                   'tournaments.name as torneo')->first();
        }
        elseif($request->query('stage_id')){
            $tt = TimeTable::join('stages', 'stages.id', 'time_tables.stage_id')
                ->join('teams as a', 'a.id', 'time_tables.team_id_a')
                ->join('teams as b', 'b.id', 'time_tables.team_id_b')
                ->join('tournaments', 'tournaments.id', 'stages.tournament_id')
                ->where('time_tables.id', $id)
                ->select('time_tables.*', 'stages.name as title',
                    'a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                    'b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b',
                    'tournaments.name as torneo')->first();
        }
        if (($tt->count())==0) abort(404);

        return view('admin.timetable.edit',  ['table'=> $tt]);
    }

    public function update(Request $request, $id)
    {
        $tt = TimeTable::find($id);
        if (($tt->count())==0) abort(404);

        $tt->place = $request->place;
        $tt->hour=$request->hour;
        $tt->date = $request->date;

        $tt->save();
        session()->flash("info", "Registro actualizado con exito");
        return back();
    }

    public function destroy($id)
    {
        $tt = TimeTable::find($id);
        if (($tt->count())!=0){
            session()->flash("success", "Fecha eliminada con exito");
            $tt->delete();
            return back();
        }
    }

    private function edit_stage($id, $request){

    }

    private function edit_group($id, $group_id){
        $tt = TimeTable::join('groups', 'groups.id', 'time_tables.group_id')
            ->where([
            ['id', $id],
            ['group_id', $group_id]
        ])
            ->select('time_tables.*')
            ->first();
        if (($tt->count())==0) abort(404);
        return view('admin.timetable.edit.group', ['timetable'=> $tt]);
    }

    private function process_group($tournament, $group){

        $tg = TeamGroup::join('teams', 'team_groups.team_id', 'teams.id')
            ->where('team_groups.group_id', $group->id)
            ->select('teams.id as id', 'teams.name as name')
            ->get();

        $tt = TimeTable::join('teams as a', 'a.id', 'time_tables.team_id_a')
            ->join('teams as b', 'b.id', 'time_tables.team_id_b')
            ->select('a.name as team_a', 'b.name as team_b', 'time_tables.*')
            ->where("group_id", $group->id)->get();

        return view('admin.timetable.group', [
            'tournament' => $tournament,
            'group' => $group,
            'teams'=> $tg,
            'timeTables'=> $tt
        ]);
    }

    private function process_stage($tournament, $stage){
        $tt = TimeTable::join('teams as a', 'a.id', 'time_tables.team_id_a')
            ->join('teams as b', 'b.id', 'time_tables.team_id_b')
            ->select('a.name as team_a', 'b.name as team_b', 'time_tables.*')
            ->where("stage_id", $stage->id)->get();

        return view("admin.timetable.stage", [
            'tournament' => $tournament,
            'stage' => $stage,
            'timeTables'=> $tt
        ]);
    }
}
