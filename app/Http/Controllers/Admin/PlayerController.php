<?php

namespace App\Http\Controllers\Admin;

use App\Player;
use App\PlayerTeam;
use App\Team;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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


    public function create($team_id)
    {
        $t = Team::find($team_id);

        $pt = PlayerTeam::join('players', 'players.id', 'player_teams.player_id')
            ->where('team_id', $team_id)->get();

        $players= Player::paginate(10);
        return view('admin.players.create',
            [   'team'=> $t,
                'team_id'=> $team_id,
                'players'=> $pt,
                'all_players'=> $players
            ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'age'=> 'integer',
            'number'=> 'required'
        ], $this->messages());


        if ($request->type_team != $request->type){
            session()->flash("warning", "El genero del jugador no coincide con el genero del equipo");
            return back();
        }

        $players = new Player();

        $players-> name = $request->get('name');
        $players-> last_name = $request->get('last_name');
        $players-> age = $request->get('age');
        $players-> dni = $request->get('dni');
        $players-> type = $request->get('type');
        $players-> observations = $request->get('observation');
        $players->number = $request->get("number");
        $players->organization_id = Auth::user()->organization_id;
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
            'age'=> 'integer',
            'number'=> 'required'
        ], $this->messages());

        $p = Player::find($id);
        if (count($p)>0){
            $p->name = $request->name;
            $p->last_name = $request->last_name;
            $p->type = $request->type;
            $p->dni = $request->dni;
            $p->age = $request->age;
            $p->observations = $request->observations;
            $p->number = $request->number;

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
            'number.required'=> 'El número de camiseta es requerido'
        ];
    }
}
