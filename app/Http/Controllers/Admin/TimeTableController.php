<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Postponed;
use App\Round;
use App\Stage;
use App\Team;
use App\TeamGroup;
use App\TimeTable;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimeTableController extends Controller
{

    # D A T E S #

    # Grupos
    public function show_dates_groups($tournament_id){
        $groups = Group::where([
            ['tournament_id', $tournament_id],
            ['class', 'group']
        ])->get();

        $dates = array();

        foreach ($groups as $g){
            $dates[$g->id] = TimeTable::where([
                ['group_id', $g->id]
            ])->get();
        }

        $teams = Team::where('tournament_id', $tournament_id)->select('id', 'name', 'logo')->get();

        return view('admin.tournament.groups.group',[
            'groups'=> $groups,
            'dates'=> $dates,
            'teams'=> $teams,
            'tournament_id'=> $tournament_id
        ]);
    }

    # Ligas
    public function dates_league($tournament_id){

        $tg = Team::where([
                ['teams.tournament_id',  $tournament_id],
                ['status', '<>',-1]
            ])
            ->select('teams.id as id', 'teams.name as name', 'teams.logo');

        if($tg->count()==0)
            return redirect(route('home'));

        $teams = array();
        foreach ($tg->get() as $t){
           $teams[] = array($t->id, $t->name, $t->logo);
        }

        return view('admin.tournament.league.liga', [
            'dates' => $this->_get_league_dates($teams),
            #'dates'=> $this->_get_league_dates_double($this->_get_league_dates($teams)),
            'teams'=> $tg->get(),
            'tournament_id'=> $tournament_id
        ]);
    }

    public function show_dates_league($group_id){
        $g = Group::find($group_id);

        $r = TimeTable::join('rounds', 'rounds.id', 'time_tables.round_id')
            ->where('time_tables.group_id', $group_id)
            ->select('rounds.id', 'rounds.name', 'rounds.status')
            ->distinct()
            ->orderBy('rounds.id')
            ->get();

        $tt = TimeTable::leftJoin('teams as a', 'a.id', 'time_tables.team_id_a')
            ->leftJoin('teams as b', 'b.id', 'time_tables.team_id_b')
            ->where([
                ['time_tables.group_id', $group_id]
            ])
            ->select('time_tables.*',
                'a.name as team_a', 'a.id as team_a_id', 'a.logo as logo_a',
                'b.name as team_b', 'b.id as team_b_id', 'b.logo as logo_b'
                )
            ->orderBy('time_tables.round_id')
            ->get();

        return view('admin.tournament.league.liga-show', [
            'league'=> $g,
            'rounds'=> $r,
            'time_tables'=> $tt
        ]);
    }

    private function _get_league_dates($teams){

        shuffle($teams);

        $n = count($teams);
        $par = ($n%2 == 0);
        if($par)
            $rondas = $n-1;
            #$rondas = $n*2-2;
        else
            $rondas = $n;

        $a  = array();
        $b = array();

        for ($i=0; $i<($n/2);$i++){
            $a[] = $teams[$i][0];
        }

        if(!$par) {
            $limit_b = ($n / 2) + 1;
            $b[] = 0;
        }
        else
            $limit_b = ($n/2);

        for ($i=$limit_b; $i<$n;$i++){
            $b[] = $teams[$i][0];
        }
        rsort($b);

        $dates = array();
        for ($ronda = 0; $ronda<$rondas; $ronda++){
            //echo "<h2>Ronda # ".($ronda+1)."</h2>";
            $vs = array();
            for ($i=0;$i<count($a); $i++){
               // echo $a[$i].''.$this->_find($teams,$a[$i]).' vs ';
                //echo $b[$i].''. $this->_find($teams,$b[$i])."<br>";
                $vs[]= [
                    'a'=> $this->_find($teams,$a[$i]),
                    'b'=> $this->_find($teams,$b[$i])
                ];
                shuffle($vs);
            }
            $dates[] = $vs;
            $b[] = array_pop($a);
            array_splice( $a, 1, 0,  array_shift($b));
        }
        return $dates;
    }

    private function _get_league_dates_double($dates){
        $double = $dates;
        foreach($dates as $rondas) {
            $newVs = array();
            foreach ($rondas as $vs) {
                $tmp_a = $vs['a'];
                $vs['a'] = $vs['b'];
                $vs['b'] = $tmp_a;
                $newVs[] = $vs;
            }
            $double[] = $newVs;
        }
        return $double;
    }

    # Posponer Fechas
    public function postponed(Request $request){

        $request->validate([
            'round_from'=> 'required',
            'round_to'=> 'required',
            'description'=> 'required',
        ]);

        if($request->round_from == $request->round_to){
            session()->flash("warning", "No se puede postergar a la misma fecha!");
            return back();
        }

        //old
        $ttold = TimeTable::find($request->time_table_id);
        if(!$ttold){
            session()->flash('warning', 'No exite la fecha');
            return back();
        }
        $ttold->status = -2; // pospuesto
        $ttold->save();


        //new
        $ttnew = new TimeTable();
        $ttnew->date = $request->date;
        $ttnew->hour = $request->hour;
        $ttnew->team_id_a = $ttold->team_id_a;
        $ttnew->team_id_b = $ttold->team_id_b;
        $ttnew->status = -1;
        $ttnew->group_id = $ttold->group_id;
        $ttnew->round_id = $request->round_to;
        $ttnew->save();

        //postergando...
        $admin = new AdminController();
        $p = new Postponed();
        $p->description = $request->description;
        $p->time_table_id_old = $request->time_table_id;
        $p->time_table_id_new = $ttnew->id;
        $p->justify = $admin->uploadImage($request->file('image'), 'img/postponed/', null);
        $p->save();



        session()->flash('success', 'Partido postergado con éxito');
        return back();
    }

    # C R U D S   P R O C C E S
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

    public function store_ligue(Request $request){
        DB::beginTransaction();
            $g = new Group();
            $g->name = $request->name;
            $g->tournament_id = $request->id;
            $g->class = 'league';
            $g->status =0;
            $g->save();


            $teams= Team::where([
                ['tournament_id', $request->get("id")]
            ])->select('id')->get();

            foreach ($teams as $t){
                $tg = new TeamGroup();
                $tg->team_id = $t->id;
                $tg->group_id = $g->id;
                $tg->save();
            }

            $i = 1;
            foreach ($request->get('dates') as $round){

                $r = new Round();
                $r->name = 'Fecha '.$i;
                $r->status = 0;
                $r->save();

                foreach ($round as $vs) {
                    $tt = new TimeTable();
                    if (isset($vs['date'])) {
                        $tt->date = $vs['date'];
                        $tt->hour = $vs['time'];
                    }
                    $tt->team_id_a = $vs['team_a'];
                    $tt->team_id_b = $vs['team_b'];
                    $tt->round_id = $r->id;
                    $tt->group_id = $g->id;
                    $tt->save();
                }

                $i++;
            }
        DB::commit();
        return response()->json(['r'=> 'ok', 'm'=> 'Liga creada con éxito!']);
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

    public function update_api(Request $request){

        foreach ($request->times as $time){
            if(($time['hour']!='' || $time['hour']!=null ) && ($time['date']!=null || $time['date']!='')) {
                $tt = TimeTable::find($time['time_table_id']);
                if ($tt) {
                    $tt->hour = $time['hour'];
                    $tt->date = $time['date'];
                    $tt->save();
                }
            }
        }
        return response()->json(['msg'=> "Fechas actualizadas con éxito"]);
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

    private function _find($array, $id){
        foreach ($array as $item){
            if($item[0] == $id)
                return $item;
        }
        return "";
    }
}
