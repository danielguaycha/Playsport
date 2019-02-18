<?php

namespace App\Http\Controllers\Guest;

use App\Group;
use App\Page;
use App\Stage;
use App\Stat;
use App\TeamGroup;
use App\TimeTable;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TorneoController extends Controller
{

    public function show_groups($id)
    {
        //$t = Tournament::find($id);
        $t = $this->_get_tournament($id);

        $p = Page::where([
            ['type', 'tournament'],
            ['parent', $t->id]
        ])->select('title', 'url')->get();



        $g = Group::where('tournament_id', $t->id)->get();


        $tg = TeamGroup::join('teams', 'teams.id', 'team_groups.team_id')
            ->select("team_groups.*", 'teams.name', 'teams.alias', 'teams.logo', 'teams.type')
            ->selectRaw('team_groups.gf - team_groups.gc as gd')
            ->orderBy('team_groups.pts', 'desc')
            ->orderBy('gd', 'desc')
            ->get();

        return view('guest.torneo.groups', [
            'tournament'=> $t,
            'groups'=> $g,
            'teams'=> $tg,
            'pages'=> $p
        ]);
    }

    public function show_top($id){
        $t = $this->_get_tournament($id);
        if (($t->count())==0) {abort(404);}
        $p = Page::where([
            ['type', 'tournament'],
            ['parent', $t->id]
        ])->select('title', 'url')->get();

        /*$goals = Stat::join('players', 'players.id', 'stats.player_id')
            ->join('player_teams', 'player_teams.player_id', 'players.id')
            ->join('teams', 'teams.id', 'player_teams.team_id')
            ->where("stats.tournament_id", $t->id)
            ->select('players.name', 'players.last_name', 'stats.goals', 'teams.name as team', 'teams.alias',
                'teams.logo', 'teams.type')
            ->orderBy('stats.goals', 'desc')
            ->limit(5)
            ->get();*/

        $goals = Stat::join('players', 'players.id', 'stats.player_id')
        ->join('player_teams', 'player_teams.player_id', 'players.id')
        ->join('teams', 'teams.id', 'player_teams.team_id')
        ->select(DB::raw('SUM(stats.goals) as goals'), 'stats.player_id', 'players.name',
            'players.last_name', 'teams.name as team', 'teams.alias',
            'teams.logo', 'teams.type')
        ->where("stats.tournament_id", $t->id)
        ->groupBy('stats.player_id', 'teams.name', 'teams.alias', 'teams.type', 'teams.logo', 'players.name',
            'players.last_name')
        ->orderBy('goals', 'desc')
        ->limit(8)
        ->get();


        return view('guest.torneo.top', [
            'goals'=> $goals,
            'tournament'=> $t,
            'pages'=> $p
        ]);
    }

    public function show_times($id, Request $request){

        $t = $this->_get_tournament($id);
        if (($t->count())==0) {abort(404);}

        $p = Page::where([
            ['type', 'tournament'],
            ['parent', $t->id]
        ])->select('title', 'url')->get();

        $g = Group::where([
            ['tournament_id', $t->id],
            ['class', 'group']
        ]);

        $tt = TimeTable::join('groups', 'groups.id', 'time_tables.group_id')
            ->join('teams as a', 'a.id', 'time_tables.team_id_a')
            ->join('teams as b', 'b.id', 'time_tables.team_id_b')
            ->leftJoin('results', 'results.time_table_id', 'time_tables.id')
            ->where('groups.tournament_id', $t->id)
            ->select('time_tables.*', 'groups.name as group',
                'a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                'b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b',
                'results.result_a', 'results.result_b');


        $tt = $tt->orderBy('groups.name', 'asc')
            ->orderBy('date', 'asc')
            ->orderBy('hour', 'asc')
            ->get();

        /*Liguilla*/

        $league = Group::where([
            ['tournament_id', $t->id],
            ['class', 'league']
        ])->first();

        $r = array();
        $tt2 = array();

        if ($league) {

            $r = TimeTable::join('rounds', 'rounds.id', 'time_tables.round_id')
                ->where('time_tables.group_id', $league->id)
                ->select('rounds.id', 'rounds.name', 'rounds.status')
                ->distinct()
                ->get();

            $tt2 = TimeTable::leftJoin('teams as a', 'a.id', 'time_tables.team_id_a')
                ->leftJoin('teams as b', 'b.id', 'time_tables.team_id_b')
                ->leftJoin('results', 'results.time_table_id', 'time_tables.id')
                ->where([
                    ['time_tables.group_id', $league->id]
                ])
                ->select('time_tables.*',
                    'a.name as team_a', 'a.id as team_a_id', 'a.logo as logo_a',
                    'b.name as team_b', 'b.id as team_b_id', 'b.logo as logo_b'
                )
                ->orderBy('time_tables.round_id')
                ->get();
        }

       // dd($tt);
        return view('guest.torneo.times', [
            'tournament'=> $t,
            'time_groups'=> $tt,
            'pages'=> $p,
            'groups'=> $g->get(),
            'groups_num'=> $g->count(),
            'league'=> $league,
            'rounds'=> $r,
            'time_tables'=> $tt2
        ]);
    }

    public function show_page($id, $page){
        $t = $this->_get_tournament($id);
        if (($t->count())==0) {abort(404);}
        $p = Page::where([
            ['type', 'tournament'],
            ['parent', $t->id]
        ])->select('title', 'url')->get();

        $content = Page::where('url', $page)->first();

        if (($content->count())== 0){abort(404);}
        return view('guest.torneo.page', [
            'tournament'=> $t,
            'pages'=> $p,
            'content'=> $content
        ]);
    }

    public function show_stage($id){
        $t = $this->_get_tournament($id);

        $stage = Stage::join('time_tables as tt', 'stages.id', 'tt.stage_id')
            ->join('teams as a', 'a.id', 'tt.team_id_a')
            ->join('teams as b', 'b.id', 'tt.team_id_b')
            ->leftJoin('results', 'results.time_table_id', 'tt.id')
            ->select('tt.*','stages.id as stage_id','stages.name as stage', 'stages.parent', 'stages.id as stage_id',
                'a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                'b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b',
                'results.result_a', 'results.result_b', 'results.penal_a', 'results.penal_b')
            ->where('stages.tournament_id', $t->id)
            ->orderBy('stages.parent', 'asc')
            ->orderBy('tt.hour', 'asc')
            ->get();


        $p = Page::where([
            ['type', 'tournament'],
            ['parent', $t->id]
        ])->select('title', 'url')->get();

        return view('guest.torneo.stages',[
            'tournament'=> $t,
            'stages'=> $stage,
            'pages' => $p
        ]);
    }

    private function _get_tournament($url){
        return $t = Tournament::join('sports', 'sports.id', 'tournaments.sports_id')
            ->where('tournaments.url', $url)
            ->select('tournaments.*', 'sports.name as sport', 'sports.denomination')
            ->first();
    }

}
