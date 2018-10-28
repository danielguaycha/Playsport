<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Sport;
use App\Stage;
use App\Team;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StageController extends Controller
{
    /**
     * StageController constructor.
     */
    public function __construct()
    {
        $this->middleware("auth");
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

            if (count($t)<=0)
                abort(404);

            $g = Group::where("tournament_id", $t->id)->get();
            if (count($g)>0){
                session()->flash("info", "Existen grupos creados para este torneo");
                return back();
            }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
