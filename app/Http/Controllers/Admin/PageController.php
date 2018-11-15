<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $p = Page::all();
        return view('admin.pages.index', ['pages'=> $p]);
        /*$p = Page::where('url', $title)->first();
        if (count($p)>0){
            return view('guest.pages.index', ['page'=>$p]);
        }else{
            abort(404);
        }*/
    }

    public function create()
    {
        $t = Tournament::where('organizations_id', Auth::user()->organization_id)->get();
        return view('admin.pages.create', ['tournaments'=> $t]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title'=> 'required|unique:pages|max:100',
            'description'=> 'max:200',
            'type' => 'required',
            'content' => 'required',
        ]);

        $p = new Page();
        $p->title = $request->get('title');
        $p->content = $request->get('content');
        $p->description = $request->get("description");
        $p->url = Str::slug($p->title);
        $p->user_id = Auth::user()->id;
        $p->type = $request->get("type");

        if ($request->get('type') == 'tournament'){
            $p->parent = $request->get("tournament");
        }

        $p->save();
        session()->flash("success", "Página guardada con exito");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {

    }

    public function edit($id)
    {
        $p = Page::find($id);
        if (($p->count())== 0){ abort(404); }

        $t = Tournament::where('organizations_id', Auth::user()->organization_id)->get();

        return view('admin.pages.edit', [
            'tournaments'=> $t,
            'page'=> $p
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=> 'required|max:100',
            'description'=> 'max:200',
            'type' => 'required',
            'content' => 'required',
        ]);

        $p = Page::find($id);

        $p->title = $request->get('title');
        $p->content = $request->get('content');
        $p->description = $request->get("description");
        $p->url = Str::slug($p->title);
        $p->user_id = Auth::user()->id;
        $p->type = $request->get("type");

        if ($request->get('type') == 'tournament'){
            $p->parent = $request->get("tournament");
        }

        $p->save();
        session()->flash("success", "Página actualizada con exito");
        return back();
    }

    public function destroy($id)
    {
        $p = Page::find($id);
        if(($p->count())==0){abort(404);}
        $p->delete();
        session()->flash("success", "Página eliminada con exito!");
        return back();
    }
}
