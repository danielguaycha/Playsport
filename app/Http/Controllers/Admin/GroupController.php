<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Round;
use App\Sport;
use App\Team;
use App\TeamGroup;
use App\TimeTable;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * GroupController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function process(Request $request, $id){
        #Status>>-1: Eliminado | 0: En proceso | 1: Finalizado
        if(!$request->has('opc'))
            abort(404);

        $g = Group::find($id);
        if(!$g)
            abort(404);

        switch ($request->get('opc')){
            case 'end':
                $g->status = 1;
                break;
            case 'active':
                $g->status = 0;
                break;
        }
        $g->save();
        session()->flash('success', 'Estado actualizado con éxito');
        return back();
    }

    public function index()
    {
        return view('admin.groups.index');
    }

    public function create(Request $request)
    {
        if(!$request->query('tournament')) {
            $t = Tournament::where([
                ['status', 1],
                ['organizations_id', Auth::user()->organization_id]
            ])->get();
            return view('admin.groups.create', ['tournaments' => $t]);
        }else{
            $t = Tournament::find($request->query('tournament'));

            if (($t->count())<=0)
               abort(404);

            $sport = Sport::find($t->sports_id);
            $group = Group::where([
                ['tournament_id', $t->id],
                ['class', '<>', 'league']
            ])->get();


            $selectTeam = Team::join('team_groups', 'team_groups.team_id', 'teams.id')
                ->join('groups', 'groups.id', 'team_groups.group_id')
                ->select('teams.*', 'team_groups.group_id', 'groups.class')
                ->where([
                    ['teams.tournament_id', $t->id],
                    ['groups.class', 'group']
                ])->get();

            $in_group = array();
            foreach ($selectTeam as $tm){
                $in_group[] = $tm->id;
            }

            $team = Team::where([
                ['tournament_id', $t->id],
                ['status', '<>', -1],
            ])->whereNotIn('id', $in_group)->get();


            if (($team->count())<=0){
                session()->flash('info', 'Aún no hay equipos!');
            }


            return view('admin.groups.create', [
                'tournaments' => $t,
                'teams'=> $team,
                'sport'=>$sport,
                'groups'=> $group,
                'selectTeams'=>$selectTeam,
                'tournament_id'=> $request->query('tournament')
            ]);
        }
    }

    public function store(Request $request)
    {

        if (!$request->get("name"))
        {
            session()->flash('warning', 'Ingresa un nombre!');
            return redirect(route("group.create", ['tournament'=> $request->tournament_id]));
        }

        if (count($request->to_team)<=1)
        {
            session()->flash('warning', 'Necesitas escoger minimo 2 equipos para crear un grupo!');
            return redirect(route("group.create", ['tournament'=> $request->tournament_id]));
        }

        $g = new Group();
        $g->name = $request->name;
        $g->status = 0;
        $g->tournament_id = $request->tournament_id;
        $g->class = 'group';
        $g->save();


        foreach ($request->to_team as $team){
            $tg = new TeamGroup();
            $tg->group_id = $g->id;
            $tg->team_id = $team;
            $tg->save();
        }

        $this->generate_dates($g);

        session()->flash('success', 'Guardado correctamente!');
        return redirect(route("group.create", ['tournament'=> $request->tournament_id]));
    }

    public function show($id)
    {
        //
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
        $g = Group::find($id);
        $tg = TeamGroup::where('group_id', $g->id);
        $tt = TimeTable::where('group_id', $g->id)->get();

        foreach ($tt as $t){
            $r = Round::find($t->round_id);
            if($r)
                $r->delete();
            $t->delete();
        }

        $tg->delete();
        $g->delete();

        session()->flash("success", "Grupo Eliminado con exito");
        return back();
    }

    public function destroy_all($tournament_id){
        $groups = Group::where([
            ['tournament_id', $tournament_id],
            ['class', 'group']
        ])->delete();

        session()->flash('success', 'Fase de grupos eliminada con éxito');
        return back();

    }

    public function generate_dates($g){
        $teams = Team::join('team_groups', 'team_groups.team_id', 'teams.id')
            ->select('teams.*', 'team_groups.group_id')
            ->where([
                ['teams.tournament_id', $g->tournament_id],
                ['team_groups.group_id', $g->id]
            ])->get();

        $vs = array();
        foreach ($teams as $a){
            foreach ($teams as $b){
                if ($a != $b) {
                    if (!$this->_is_in_vs($vs, $a, $b)) {

                        $tt = new TimeTable();
                        $tt->team_id_a = $a->id;
                        $tt->team_id_b = $b->id;
                        $tt->group_id = $g->id;
                        $tt->save();

                        $vs[] = [$a, $b];
                    }
                }
            }
        }
    }

    private function _is_in_vs($vs, $team_a, $team_b){
        foreach ($vs as $v){
            if (($v[0]==$team_a && $v[1]==$team_b) || ($v[0]==$team_b && $v[1]==$team_a)){
                return true;
            }
        }
        return false;
    }
}
