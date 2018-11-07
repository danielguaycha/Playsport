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
            if (count($t)<=0)
                abort(404);

            $group = Group::find($request->query('group'));
            if (count($group)<=0)
                abort(404);

            return($this->process_group($t, $group));
        }

        if ($request->query('tournament') && $request->query('stage')) {
            $t = Tournament::find($request->query('tournament'));
            if (count($t)<=0)
                abort(404);

            $stage = Stage::find($request->query('stage'));
            if (count($stage)<=0)
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
                'tournaments' => $t
            ]);
        }
        else {
            $t = Tournament::find($request->query('tournament'));

            // steep two - Groups - if have any group then show this
            if (!$request->query('group')){
                $group = Group::where('tournament_id', $t->id)->get();
                if (count($group) > 0) {
                    return view("admin.timetable.create", [
                        'tournament' => $t,
                        'groups' => $group
                    ]);
                }
            }

            // steep two - Stages - if have any stage then show this
            if (!$request->query('stage')){
                $stages = Stage::where("tournament_id", $t->id)->get();
                if (count($stages)>0){
                    return view("admin.timetable.create", [
                        'tournament' => $t,
                        'stages' => $stages
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

        if (count($teams)!=2){
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
            (count($timeTable)>0?", pero ya existe un encuentro para estos equipos":"")
            ));
        $tt->save();

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id, Request $request)
    {
        if ($request->query('group_id')){
           return $this->edit_group($id, $request->query('group_id'));
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $tt = TimeTable::find($id);
        if (count($tt)!=0){
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
        if (count($tt)==0) abort(404);
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


        return view("admin.timetable.stage", [
            'tournament' => $tournament,
            'stage' => $stage
        ]);
    }
}
