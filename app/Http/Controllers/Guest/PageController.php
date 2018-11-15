<?php

namespace App\Http\Controllers\Guest;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function show_page($url){

        $p = Page::where('url', $url)->first();
        if ($p == null)
            abort(404);
        if (($p->count())==0){abort(404);}
        return view('guest.pages.index', ['page'=> $p]);
    }
}
