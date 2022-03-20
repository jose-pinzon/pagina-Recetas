<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriasReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Symfony\Component\VarDumper\Cloner\Data;

class RecetaController extends Controller
{


    public function __construct(){
        $this->middleware('auth', ['except' => ['show','search']]);
    }


    public function search(Request $request){
        $busqueda = $request['buscar'];
        $recetas = Receta::where('titulo','like','%'.$busqueda.'%' )->paginate(10);
        $recetas->appends(['buscar' => $busqueda] );//?para que no se buegue la parte de busqueda
        return view('busquedas.show',compact('recetas','busqueda'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //!recetas con paginacion
        // $recetas = Auth::user()->resetas;


        $usuario_perfil = Auth::user()->perfil;

        $usuario = auth()->user()->id;
        $likesDados =  auth()->user()->likesDados;

        $recetas = Receta::where('user_id', $usuario )->paginate(2);

        return view('recetas.index',[
            'recetas' => $recetas,
            'usuario_perfil' => $usuario_perfil,
            'likesDados' => $likesDados
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = CategoriasReceta::all(['id', 'nombre']);
        return view('recetas.create',[
                'categorias' => $categorias
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $ValidateData = $request->validate([
            'titulo' => 'required|max:255|min:5',
            'categoria' => 'required',
            'preparar'  => 'required',
            'ingredientes'  => 'required',
            'imagen'=>'required|image'
        ]);


        $ruta_imagen = $request['imagen']->store('upload-recetas','public');

        //! resize de la imagen con "intervention image" (tiene otras funcionalidades que se puede ver en su pagina oficial)
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        Auth::user()->resetas()->create([
            'titulo' => $request['titulo'],
            'ingredientes' => $request['ingredientes'],
            'preparacion' => $request['preparar'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $request['categoria'],
        ]);

        return redirect() -> route('recetas.home');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //?Revisar que el usuario ya dio like a una recetA
        $like = ( auth()->user() ) ?  auth()->user()->likesDados->contains( $receta->id ) : false;


        //?Cantidad de likes
        $cantidadLikes = $receta->likesRecibidos->count();


        return view('recetas.show', compact('receta','like','cantidadLikes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view',$receta);
        $categorias = CategoriasReceta::all(['id', 'nombre']);
        return view('recetas.edit',compact('categorias','receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        $this->authorize('update', $receta);
        $ValidateData = $request->validate([
            'titulo' => 'required|max:255|min:5',
            'categoria' => 'required',
            'preparar'  => 'required',
            'ingredientes'  => 'required',
        ]);



        //?Asignar los valores
        $receta->titulo = $ValidateData['titulo'];
        $receta->ingredientes = $ValidateData['ingredientes'];
        $receta->preparacion = $ValidateData['preparar'];
        $receta->categoria_id = $ValidateData['categoria'];


        //cambio de imagen
        if($request['imagen']){
            $ruta_imagen = $request['imagen']->store('upload-recetas','public');
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();
            $receta->imagen = $ruta_imagen;
        }

        $receta->save();

        return redirect()-> route('recetas.home')->with(['status' => 'Dato actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete',$receta);
        $receta->delete();
        return redirect()->route('recetas.home')->with(['status' => 'Eliminado correctamente']);
    }
    }

