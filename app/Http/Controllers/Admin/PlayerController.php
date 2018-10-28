<?php

namespace App\Http\Controllers\Admin;

use App\Player;
use App\PlayerTeam;
use App\Team;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Finder\Finder;

class PlayerController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(Request $request)
    {
        if($request->query('t')){
            echo $request->query('q');
        }
        return view('admin.players.index');
    }


    public function create($team)
    {
        $pt = PlayerTeam::join('players', 'players.id', 'player_teams.player_id')
            ->where('team_id', $team)->get();

        return view('admin.players.create', ['team_id'=> $team, 'players'=> $pt]);
    }

    public function store(Request $request)
    {
        $players = new Player();

        $players -> name = $request->get('name');
        $players -> last_name = $request->get('last_name');
        $players -> age = $request->get('age');
        $players -> dni = $request->get('dni');
        $players -> type = $request->get('type');
        $players -> observations = $request->get('observation');

        $players -> save();

        $pt = new PlayerTeam();

        $pt->team_id = $request->team_id;
        $pt->player_id = $players->id;

        $pt->save();

        session()->flash('success', 'Jugador '.$players->name.' agregado correctamente!') ;
        return back();
    }

    public function edit($id)
    {
        $p = Player::find($id);
        if (count($p)>0) {
            return view('admin.players.edit', ['player'=> $p]);
        }
        abort(404);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:100',
            'last_name' => 'required',
            'age'=> 'integer'
        ], $this->messages());

        $p = Player::find($id);
        if (count($p)>0){
            $p->name = $request->name;
            $p->last_name = $request->last_name;
            $p->type = $request->type;
            $p->dni = $request->dni;
            $p->age = $request->age;
            $p->observations = $request->observations;

            $p->save();
            session()->flash("success", "Registro actualizado con exito");
            return back();
        }
        abort(404);
    }

    public function destroy($id)
    {
        $p = Player::find($id);
        if (count($p)>0){
            $tc = PlayerTeam::where("player_id", $id);
            $tc->delete();
            $p->delete();
            session()->flash("success", "Jugador eliminado con exito");
            return back();
        }else{
            abort(404);
        }
    }


    public function messages()
    {
        return [
            'name.required'=> 'El nombre es requerido',
            'last_name.required' => 'El Apellido es requerido',
        ];
    }
}
