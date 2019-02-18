<?php

namespace App\Http\Controllers\Admin;

use App\Round;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoundController extends Controller
{
    public function update($id, Request $request){
        $r = Round::find($id);
        if(!$r)
            abort(404);

        switch($request->opc){
            case 'in_game':
                $r->status = 0;
                session()->flash('success', 'Se ha marcado a '.$r->name.' como: En Juego');
                break;
            case 'end_game':
                $r->status = 1;
                session()->flash('success', 'Se ha marcado a '.$r->name.' como: Finalizada');
                break;
        }

        $r->save();
        return back();
    }
}
