<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriasReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){

        // $recetas_nuevas = Receta::orderBy('created_at','ASC')->get();

        //!Mostrar recetas que tengan mas votos
        //?Esta forma puede servir para poder saber si tiene un cierto numero de algo
        // $votadas = Receta::has('likesRecibidos', '>' , 1)->get();

        $votadas = Receta::withCount('likesRecibidos')->orderBy('likes_recibidos_count', 'desc')->take(3)->get();

        //!Recetas por categoria
            $Categorias = CategoriasReceta::all();
            $recetas = [];

            foreach($Categorias as $cate){
                //el gelper Str sirve para no poner separaciones en los nombres
                $recetas[ Str::slug($cate->nombre)][] = Receta::where('categoria_id', $cate->id)->take(3)->get();
            }


        //?Con el limit podemos traer los ultimos
        $recetas_nuevas = Receta::latest()->limit(5)->get();//!este es lo mismo como el de arriba
        return view('Inicio.index',compact('recetas_nuevas','recetas','votadas'));
    }
}
