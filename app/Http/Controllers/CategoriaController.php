<?php

namespace App\Http\Controllers;

use App\CategoriasReceta;
use App\Receta;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //
    public function show(CategoriasReceta  $categoriaReceta){


        $recetas = Receta::where('categoria_id', $categoriaReceta->id )->paginate(10);

        return view('categorias.show', compact('recetas','categoriaReceta'));
    }
}
