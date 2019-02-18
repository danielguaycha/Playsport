<?php

namespace App\Http\Controllers\Guest;

use App\Group;
use App\Stage;
use App\Stat;
use App\TeamGroup;
use App\TimeTable;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request){

        if($request->query('t')){
            $condition = [['tournaments.status', '=', 0], ['tournaments.id', $request->query('t')]];
        }else{
            $condition = [['tournaments.status', '=', 0]];
        }

        $ts = Tournament::join('sports', 'sports.id', 'tournaments.sports_id')
            ->where($condition)
            ->select('tournaments.*', 'sports.name as sport', 'sports.denomination')
            ->orderBy('priority', 'asc')->first();



        /****    L I G A   ****/
            #-1 Obteniendo Datos de Liga
            $liga = Group::where([
                ['tournament_id', $ts->id],
                ['class', 'league'],
                ['status', 0]
            ])->select('id', 'name')->first();

            $liga_equipos = [];
            $rounds = [];
            $league_timetables = [];
            if($liga) {
                $liga_equipos = $this->_getLigueTeams($liga->id);

                $rounds = TimeTable::join('rounds', 'rounds.id', 'time_tables.round_id')
                    ->where('time_tables.group_id', $liga->id)
                    ->select('rounds.id', 'rounds.name', 'rounds.status')
                    ->distinct()
                    ->orderBy('rounds.id', 'asc')
                    ->get();

                $league_timetables = TimeTable::leftJoin('teams as a', 'a.id', 'time_tables.team_id_a')
                    ->leftJoin('teams as b', 'b.id', 'time_tables.team_id_b')
                    ->leftJoin('results', 'results.time_table_id', 'time_tables.id')
                    ->where([
                        ['time_tables.group_id', $liga->id]
                    ])
                    ->select('time_tables.*',
                        'a.name as team_a', 'a.id as team_a_id', 'a.logo as logo_a',
                        'b.name as team_b', 'b.id as team_b_id', 'b.logo as logo_b',
                        'results.result_a', 'results.result_b'
                    )
                    ->orderBy('time_tables.date')
                    ->orderBy('time_tables.hour')
                    ->get();
            }

        /**** F A S E   D E   G R U P O S  ****/
            #-1 Obteniendo Grupos
            $grupos = Group::where([
                ['tournament_id', $ts->id],
                ['class', 'group'],
                ['status', 0]
            ])->select('id', 'name')->get();

            $grupos_equipos = array();
            $grupos_fechas = array();

            if ($grupos) {
                $grupos_equipos = $this->_getGroups($grupos);
                $grupos_fechas = $this->_getGroupsDate($ts->id);
                
            }

        /****O T R O S  T O R N E O S***/
            $others = Tournament::join('sports', 'sports.id', 'tournaments.sports_id')
                ->where([
                    ['tournaments.status', '=', 0],
                    ['tournaments.id', '<>', $ts->id]
                ])
                ->select('tournaments.*', 'sports.name as sport')
                ->orderBy('priority', 'asc')->limit(8)->get();
        /*** E S T A D I S T I C A***/

        return view('guest.home.index', [
            'tournament'=> $ts,
            'liga'=> $liga,
            'liga_equipos'=> $liga_equipos,
            'liga_rondas'=> $rounds,
            'liga_fechas'=> $league_timetables,
            'groups'=> $grupos,
            'groups_dates'=> $grupos_fechas,
            'teams'=> $grupos_equipos,
            'stages'=> $this->_getStage($ts->id),
            'others'=> $others,
            'stats'=> $this->_getStats($ts->id)
        ]);
    }

    private function _getStage($tournament_id){
        return Stage::join('time_tables as tt', 'stages.id', 'tt.stage_id')
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

    }

    private function _getGroups($grupos){
        $ids = array();
        foreach ($grupos as $g){
            $ids[] = $g->id;
        }
        return TeamGroup::join('teams', 'teams.id', 'team_groups.team_id')
            ->whereIn('team_groups.group_id', $ids)
            ->select("team_groups.*", 'teams.name', 'teams.alias', 'teams.logo', 'teams.type')
            ->selectRaw('team_groups.gf - team_groups.gc as gd')
            ->orderBy('team_groups.pts', 'desc')
            ->orderBy('gd', 'desc')
            ->get();
    }

    private function _getGroupsDate($tournament_id){
        return TimeTable::join('groups', 'groups.id', 'time_tables.group_id')
            ->join('teams as a', 'a.id', 'time_tables.team_id_a')
            ->join('teams as b', 'b.id', 'time_tables.team_id_b')
            ->leftJoin('results', 'results.time_table_id', 'time_tables.id')
            ->where([
                ['groups.tournament_id', $tournament_id],
                ['groups.class', 'group']
            ])
            ->select('time_tables.*', 'groups.name as group',
                'a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                'b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b',
                'results.result_a', 'results.result_b')
            ->orderBy('time_tables.date')
            ->orderBy('time_tables.hour')
            ->get();
    }

    private function _getLigueTeams($group_id){
        return TeamGroup::join('teams', 'teams.id', 'team_groups.team_id')
            ->where([
                ['team_groups.group_id', $group_id],
                ['teams.status', '<>', -1]
            ])
            ->select("team_groups.*", 'teams.name', 'teams.alias', 'teams.logo', 'teams.type')
            ->selectRaw('team_groups.gf - team_groups.gc as gd')
            ->orderBy('team_groups.pts', 'desc')
            ->orderBy('gd', 'desc')
            ->get();

    }

    private function _getStats($tournament_id){
        return Stat::join('players', 'players.id', 'stats.player_id')
            ->join('player_teams', 'player_teams.player_id', 'players.id')
            ->join('teams', 'teams.id', 'player_teams.team_id')
            ->select(DB::raw('SUM(stats.goals) as goals'), 'stats.player_id', 'players.name',
                'players.last_name', 'teams.name as team', 'teams.alias',
                'teams.logo', 'teams.type')
            ->where("stats.tournament_id", $tournament_id)
            ->groupBy('stats.player_id', 'teams.name', 'teams.alias', 'teams.type', 'teams.logo', 'players.name',
                'players.last_name')
            ->orderBy('goals', 'desc')
            ->limit(8)
            ->get();
    }
}
