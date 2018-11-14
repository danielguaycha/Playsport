<?php

namespace App\Http\Controllers\Admin;

use App\GroupControl;
use App\PlayerTeam;
use App\Result;
use App\Stat;
use App\TeamGroup;
use App\TimeTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $tt = TimeTable::find($id);

        if (count($tt)<=0) abort(404);

        if ($tt->group_id != null ){
            return $this->process_group($id);
        }

        if ($tt->stage_id !=null){
            return $this->process_stage($id);
        }
        //abort(404);
    }

    public function store_result(Request $request){

        if (!$request->btn_store){
            abort(404);
        }

        switch ($request->btn_store){
            case "update":
                return $this->_update_results($request);
            case 'end':
                $this->_update_results($request);
                $this->_group_revert_stats($request);
                return $this->_end_results($request);
            case 'revert':
                return $this->_group_revert_stats($request);
            case 'end_volley':
                $request->validate([
                   'team_winner'=> 'required'
                ]);
                $this->_update_results($request);
                $this->_group_revert_stats($request);
                return $this->_end_results($request);
            case 'status':

                break;
            default:
                abort(404);
                break;
        }

    }

    public function store_stats(Request $request){
        $request->validate([
           'goals'=> 'integer',
            'yellow'=> 'integer',
            'red'=> 'integer'
        ]);

        $st = Stat::where([
            ['player_id', $request->player_id],
            ['time_table_id', $request->time_table_id]
        ]);

        if ($st->count()==0){

            if ($request->goals == 0){
                session()->flash("warning", "No puedes guardar stats vacios");
                return back();
            }

            $s = new Stat();
            $s->goals = $request->get("goals");
            $s->yellow = $request->get("yellow");
            $s->red = $request->get("red");
            $s->player_id = $request->get("player_id");
            $s->tournament_id = $request->get("tournament_id");
            $s->team_id = $request->get("team_id");
            $s->observation = '';
            $s->time_table_id = $request->get("time_table_id");
            session()->flash("success", 'Stats Guardados');
            $s->save();
        }else{
            $st->increment('goals', $request->goals);
            $st->increment('yellow', $request->yellow);
            $st->increment('red', $request->red);
            session()->flash("info", "Stats Actualizado");
        }

        return back();
    }

    public function update_status($time_table_id, Request $request){
        if ($request->has('btn_status')){
            $tt = TimeTable::find($time_table_id);
            if (count($tt)==0) abort(404);

            $tt->status = $request->btn_status;
            $tt->save();
            session()->flash("success", "Estado cambiado");
            return back();
        }
        abort(404);
    }

    public function destroy_stats($id){
        $s = Stat::find($id);
        if (count($s)>0){
            $s->delete();
            session()->flash("success", "Eliminación correcta");
            return back();
        }
    }

    private function process_stage($id){
        $tt = TimeTable::join('stages', 'stages.id', 'time_tables.stage_id')
            ->join('teams as a', 'a.id', 'time_tables.team_id_a')
            ->join('teams as b', 'b.id', 'time_tables.team_id_b')
            ->leftJoin('results', 'results.time_table_id', 'time_tables.id')
            ->where('time_tables.id', $id)
            ->select('time_tables.*','stages.name as stage', 'stages.tournament_id',
                'a.id as team_id_a','a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                'b.id as team_id_b','b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b',
                'results.result_a', 'results.result_b', 'results.penal_a', 'results.penal_b')
            ->first();
        return view('admin.results.edit', [
            'time_tables'=> $tt,
            'players'=> $this->_get_players($tt->team_id_a, $tt->team_id_b),
            'stats'=> $this->_get_stats($tt->id, $tt->team_id_a, $tt->team_id_b)
        ]);
    }

    private function process_group($id){
        $tt = TimeTable::join('groups', 'groups.id', 'time_tables.group_id')
            ->join('teams as a', 'a.id', 'time_tables.team_id_a')
            ->join('teams as b', 'b.id', 'time_tables.team_id_b')
            ->join('tournaments', 'tournaments.id', 'groups.tournament_id')
            ->leftJoin('results', 'results.time_table_id', 'time_tables.id')
            ->where('time_tables.id', $id)
            ->select('time_tables.*','groups.name as group', 'groups.tournament_id',
                'a.id as team_id_a','a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                'b.id as team_id_b','b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b',
                'results.result_a', 'results.result_b', 'results.penal_a', 'results.penal_b',
                'tournaments.sports_id as sport_id')
            ->first();
        //dd($tt);
        return view('admin.results.edit', [
            'time_tables'=> $tt,
            'players'=> $this->_get_players($tt->team_id_a, $tt->team_id_b),
            'stats'=> $this->_get_stats($tt->id, $tt->team_id_a, $tt->team_id_b)
        ]);
    }

    private function _end_results($request){
        $rs = TimeTable::where('id', $request->get('time_table_id'))->first();
        $rs->status = 1;
        $rs->save();

        if($request->has('team_winner')){
            if ($rs->team_id_a == $request->team_winner){
                $this->_group_add_winner($rs->id, $rs->team_id_a, $request->result_a, $request->result_b);
                $this->_group_add_loser($rs->id, $rs->team_id_b, $request->result_b, $request->result_a);
                session()->flash("info", "Ganador Equipo A");
                return back();
            }else{
                $this->_group_add_winner($rs->id, $rs->team_id_b, $request->result_b, $request->result_a);
                $this->_group_add_loser($rs->id, $rs->team_id_a, $request->result_a, $request->result_b);
                session()->flash("info", "Ganador Equipo B");
                return back();
            }
        }else {
            $ta = $rs->team_id_a;
            $rsa = $request->result_a;

            $tb = $rs->team_id_b;
            $rsb = $request->result_b;
        }

        if ($rsa > $rsb){
            session()->flash("info", "Ganador Equipo A");
            $this->_group_add_winner($rs->id, $ta, $request->result_a, $request->result_b);
            $this->_group_add_loser($rs->id, $tb, $request->result_b, $request->result_a);
            return back();
        }else if($rsb > $rsa){
            session()->flash("info", "Ganador Equipo B");
            $this->_group_add_winner($rs->id, $tb, $request->result_b, $request->result_a);
            $this->_group_add_loser($rs->id, $ta, $request->result_a, $request->result_b);
            return back();
        }else if($rsa == $rsb){
            $this->_group_add_tied($rs->id, $ta, $request->result_a, $request->result_b);
            $this->_group_add_tied($rs->id, $tb, $request->result_b, $request->result_a);
            session()->flash("info", "Partido Empatado");
            return back();
        }
    }

    // Define winner
    private function _group_add_winner($time_table, $team_id, $goals, $contra){

        $ga = TeamGroup::where('team_id', $team_id);

        $gc = new GroupControl();
        $gc->pj = 1;
        $gc->pg = 1;
        $gc->gf = $goals;
        $gc->gc = $contra;
        $gc->pts = 3;
        $gc->time_table_id = $time_table;
        $gc->team_group_id = $ga->first()->id;
        $gc->team_id=$team_id;
        $gc->save();

        $ga->increment('pj', 1);
        $ga->increment('pg', 1);
        $ga->increment('gf', $goals);
        $ga->increment('gc', $contra);
        $ga->increment('pts', 3);
    }

    // Define loser
    private function _group_add_loser($time_table, $team_id, $goals, $contra){
        $ga = TeamGroup::where('team_id', $team_id);

        $gc = new GroupControl();
        $gc->pj = 1;
        $gc->pp = 1;
        $gc->gf = $goals;
        $gc->gc = $contra;
        $gc->time_table_id = $time_table;
        $gc->team_group_id = $ga->first()->id;
        $gc->team_id=$team_id;
        $gc->save();

        $ga->increment('pj', 1);
        $ga->increment('pp', 1);
        $ga->increment('gf', $goals);
        $ga->increment('gc', $contra);
    }

    // Define tied match
    private function _group_add_tied($time_table, $team_id, $goals, $contra){
        $ga = TeamGroup::where('team_id', $team_id);

        $gc = new GroupControl();
        $gc->pj = 1;
        $gc->pe = 1;
        $gc->gf = $goals;
        $gc->gc = $contra;
        $gc->time_table_id = $time_table;
        $gc->team_group_id = $ga->first()->id;
        $gc->team_id=$team_id;
        $gc->pts = 1;
        $gc->save();

        $ga->increment('pj', 1);
        $ga->increment('pe', 1);
        $ga->increment('gf', $goals);
        $ga->increment('gc', $contra);
        $ga->increment('pts', 1);
    }

    private function _group_revert_stats($request){
        $rs = TimeTable::where('id', $request->get('time_table_id'))->first();
        $rs->status = -1;
        $rs->save();

        $group_controls = GroupControl::where('time_table_id', $request->get("time_table_id"));
        if ($group_controls->count()>0) {
            foreach ($group_controls->get() as $gc) {
                $tg = TeamGroup::where('id', $gc->team_group_id);
                $tg->increment('pj', (-1 * $gc->pj));
                $tg->increment('pg', (-1 * $gc->pg));
                $tg->increment('pe', (-1 * $gc->pe));
                $tg->increment('pp', (-1 * $gc->pp));
                $tg->increment('gf', (-1 * $gc->gf));
                $tg->increment('gc', (-1 * $gc->gc));
                $tg->increment('pts', (-1 * $gc->pts));
            }
            $group_controls->delete();
            session()->flash("warning", "Valores revertidos");
            return back();
        }
        session()->flash("info", "Todos los stats fueron revertidos");
        return back();
    }

    private function _update_results($request){
        $rs = Result::where('time_table_id', $request->get('time_table_id'))->first();
        if (count($rs)==0){
            $rs = new Result();
            $rs->result_a = $request->get("result_a");
            $rs->result_b = $request->get("result_b");
            $rs->penal_a = $request->get("penal_a");
            $rs->penal_b = $request->get("penal_b");
            $rs->time_table_id = $request->get("time_table_id");
            $rs->save();
        }else{
            $rs->result_a = $request->get("result_a");
            $rs->result_b = $request->get("result_b");
            $rs->penal_a = $request->get("penal_a");
            $rs->penal_b = $request->get("penal_b");
            $rs->time_table_id = $request->get("time_table_id");
            $rs->save();
        }
        $rs = TimeTable::where('id', $request->get('time_table_id'))->first();
        $rs->status = 1;
        $rs->save();
        session()->flash('info', 'Actualizado con exito');
        return back();
    }

    private function _get_players($team_a, $team_b){
        $pta = PlayerTeam::join('players', 'players.id', 'player_teams.player_id')
            ->join('teams', 'teams.id', 'player_teams.team_id')
            ->select('players.name', 'players.last_name', 'players.number','players.id')
            ->where('teams.id', $team_a)->orderBy('players.number')->get();

        $ptb = PlayerTeam::join('players', 'players.id', 'player_teams.player_id')
            ->join('teams', 'teams.id', 'player_teams.team_id')
            ->select('players.name', 'players.last_name', 'players.number' ,'players.id')
            ->where('teams.id', $team_b)->orderBy('players.number')->get();

        return ['players_a'=>$pta, 'players_b'=> $ptb];
    }

    private function _get_stats($time_table_id, $team_a, $team_b){
        return Stat::join('players', 'players.id', 'stats.player_id')
            ->where([
                ['time_table_id', $time_table_id],
                ['team_id', $team_a]
            ])->orWhere([
                ['time_table_id', $time_table_id],
                ['team_id', $team_b]
            ])
            ->select('players.name', 'players.last_name', 'players.number',
                    'stats.yellow', 'stats.red', 'stats.goals', 'stats.team_id', 'stats.id')
            ->orderBy('players.number')
            ->get();
    }
}
