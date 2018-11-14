<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tournament;
use App\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TournamentController extends Controller
{
    public function index()
    {
        $t = Tournament::join('sports', 'tournaments.sports_id', 'sports.id')
            ->join('organizations', 'tournaments.organizations_id', 'organizations.id')
            ->where([
                ['tournaments.organizations_id', Auth::user()->organization_id],
            ])
            ->select('sports.name as sport', 'tournaments.*', 'organizations.name as organization')
            ->orderBy('tournaments.status', 'desc')
            ->get();
        return view('admin.tournament.index',['tournaments'=> $t]);
    }

    public function create()
    {
        $sport = Sport::all();
        return view('admin.tournament.create')->with(['sports' => $sport]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:tournaments|max:100',
            'date_init'=> 'required',
            'date_end'=> 'required',
        ]);

        $tournament = new Tournament();

        $tournament -> name = $request->get('name');
        $tournament -> date_init = $request->get('date_init');
        $tournament -> date_end = $request->get('date_end');
        $tournament -> type = $request->get('type');
        $tournament -> logo = "logo.png";
        $tournament -> url = Str::slug($tournament->name);
        $tournament -> status = 1;
        $tournament -> rules = "rules";
        $tournament -> sports_id = $request->get('sport');
        //$tournament -> sport_id = 1;
        //$tournament -> organization_id = Auth::user()->organization_id;
        $tournament -> organizations_id = Auth::user()->organization_id;

        $tournament -> save();

        session()->flash('success', 'Datos correctamente ingresados') ;
        return redirect()->route('tournament.store');
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
        $t = Tournament::find($id);
        if(count($t)>0) {
            $sports = Sport::all();
            return view('admin.tournament.edit', ['tournament'=> $t, 'sports'=> $sports]);
        }

        abort(404);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|max:100',
            'date_init'=> 'required',
            'date_end'=> 'required',
        ]);

        $t = Tournament::find($id);
        if (count($t)>0){
            $t->name = $request->name;
            $t->date_init = $request->date_init;
            $t->date_end = $request->date_end;
            $t->type = $request->type;
            $t-> url = Str::slug($request->url);
            $t->sports_id = $request->sport_id;
            $t->rules = $request->rules;

            $t->save();

            session()->flash("success", "Registro actualizado con exito");
            return back();
        }
        abort(404);
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
