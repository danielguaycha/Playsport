<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Sport;
use App\Team;
use App\TeamGroup;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $group = Group::where('tournament_id', $t->id)->get();

            $team = Team::leftJoin('team_groups', 'teams.id', 'team_groups.team_id')
                ->select('teams.*', 'team_groups.group_id')
                ->where([
                    ['teams.sport_id', $t->sports_id],
                    ['type', $t->type]
                ])->get();

            if (($team->count())<=0){
               session()->flash('info', 'Aún no hay equipos!');
            }

            return view('admin.groups.create', [
               'tournaments' => $t,
               'teams'=> $team,
               'sport'=>$sport,
               'groups'=> $group,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->get("name"))
        {
            session()->flash('warning', 'Ingresa un nombre!');
            return redirect(route("group.create", ['tournament'=> $request->tournament_id]));
        }

        if (($request->get("to_team")->count())<=1)
        {
            session()->flash('warning', 'Necesitas escoger minimo 2 equipos para crear un grupo!');
            return redirect(route("group.create", ['tournament'=> $request->tournament_id]));
        }


        $g = new Group();
        $g->name = $request->name;
        $g->status = 1;
        $g->tournament_id = $request->tournament_id;
        $g->save();


        foreach ($request->to_team as $team){
            $tg = new TeamGroup();
            $tg->group_id = $g->id;
            $tg->team_id = $team;
            $tg->save();
        }

        session()->flash('success', 'Guardado correctamente!');
        return redirect(route("group.create", ['tournament'=> $request->tournament_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


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
        $g = Group::find($id);
        $tg = TeamGroup::where('group_id', $g->id);
        $tg->delete();
        $g->delete();
        session()->flash("success", "Grupo Eliminado con exito");
        return back();
    }
}
