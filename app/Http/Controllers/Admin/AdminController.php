<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(){
        $tc = new TournamentController();
        return view('admin.index', ['tournaments'=> $tc->getTournament()]);
    }


    public function removeImage($path){
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    public function uploadImage($image, $path, $options = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 666, true);
        }
        if(!$image || $image == null)
            return '';
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path($path .'/'. $input['imagename']);
        $img = Image::make($image->getRealPath());

        if($options!=null){
            if(isset($options['width']) and isset($options['height'])){
                $img->resize($options['width'], $options['height']);
            }
        }
        $img->save($destinationPath);
        return $path."/".$input['imagename'];
    }

}
