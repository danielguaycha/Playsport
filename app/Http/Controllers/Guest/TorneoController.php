<?php

namespace App\Http\Controllers\Guest;

use App\Group;
use App\Page;
use App\Stat;
use App\TeamGroup;
use App\TimeTable;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TorneoController extends Controller
{

    public function show_groups($id)
    {
        //$t = Tournament::find($id);
        $t = $this->_get_tournament($id);

        $p = Page::where([
            ['type', 'tournament'],
            ['parent', $id]
        ])->select('title', 'url')->get();
        if (count($t)==0) {abort(404);}

        $g = Group::where('tournament_id', $id)->get();
        if (count($g)==0){abort(404);}

        $tg = TeamGroup::join('teams', 'teams.id', 'team_groups.team_id')
            ->select("team_groups.*", 'teams.name', 'teams.alias', 'teams.logo', 'teams.type')
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
        if (count($t)==0) {abort(404);}
        $p = Page::where([
            ['type', 'tournament'],
            ['parent', $id]
        ])->select('title', 'url')->get();

        $goals = Stat::join('players', 'players.id', 'stats.player_id')
            ->join('player_teams', 'player_teams.player_id', 'players.id')
            ->join('teams', 'teams.id', 'player_teams.team_id')
            ->where("stats.tournament_id", $id)
            ->select('players.name', 'players.last_name', 'stats.goals', 'teams.name as team', 'teams.alias', 'teams.logo', 'teams.type')
            ->orderBy('stats.goals', 'desc')
            ->limit(5)
            ->get();

        return view('guest.torneo.top', [
            'goals'=> $goals,
            'tournament'=> $t,
            'pages'=> $p
        ]);
    }

    public function show_times($id){
        $t = $this->_get_tournament($id);
        if (count($t)==0) {abort(404);}

        $p = Page::where([
            ['type', 'tournament'],
            ['parent', $id]
        ])->select('title', 'url')->get();

        $g = Group::where('tournament_id', $id)->count();

        $tt = TimeTable::join('groups', 'groups.id', 'time_tables.group_id')
            ->join('teams as a', 'a.id', 'time_tables.team_id_a')
            ->join('teams as b', 'b.id', 'time_tables.team_id_b')
            ->where('groups.tournament_id', $id)
            ->select('time_tables.*','groups.name as group',
                    'a.name as team_a', 'a.alias as alias_a', 'a.type as type_a', 'a.logo as logo_a',
                    'b.name as team_b', 'b.alias as alias_b', 'b.type as type_b', 'b.logo as logo_b')
            ->orderBy('date', 'asc')
            ->orderBy('hour', 'asc')
            ->get();

        return view('guest.torneo.times', [
            'tournament'=> $t,
            'time_groups'=> $tt,
            'pages'=> $p,
            'groups'=> $g
        ]);
    }

    public function show_page($id, $page){
        $t = $this->_get_tournament($id);
        if (count($t)==0) {abort(404);}
        $p = Page::where([
            ['type', 'tournament'],
            ['parent', $id]
        ])->select('title', 'url')->get();

        $content = Page::where('url', $page)->first();

        if (count($content)== 0){abort(404);}
        return view('guest.torneo.page', [
            'tournament'=> $t,
            'pages'=> $p,
            'content'=> $content
        ]);
    }

    private function _get_tournament($id){
        return Tournament::join('sports', 'sports.id', 'tournaments.sports_id')
            ->where('tournaments.id', $id)
            ->select('tournaments.*', 'sports.name as sport', 'sports.denomination')
            ->first();
    }
}
