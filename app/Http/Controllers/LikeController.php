<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function update(Request $request, Receta $receta)
    {
        //el toggle tiene la funcion de quitar o poner likes, si tiene like lo quitara y si no lo guardara
        return auth()->user()->likesDados()->toggle($receta);
    }

}
