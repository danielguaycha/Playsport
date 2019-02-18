<?php

namespace App\Http\Controllers\Admin;

use App\Postponed;
use App\TimeTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostPonedController extends Controller
{
    public function destroy($time_table_id){

        $p = Postponed::where('time_table_id_old', $time_table_id)->first();
        if(!$p)
            abort(404);

        $ttnew = TimeTable::find($p->time_table_id_new);
        if($ttnew)
            $ttnew->delete();

        $ttold = TimeTable::find($p->time_table_id_old);
        if($ttold) {
            $ttold->status = -1;
            $ttold->save();
        }

        if($p->justify != '') {
            $admin = new AdminController();
            $admin->removeImage($p->justify);
        }
        $p->delete();

        session()->flash('success', 'Postergación eliminada con exito');
        return back();
    }
}
