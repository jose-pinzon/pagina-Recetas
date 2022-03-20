<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(2);
        return view('perfiles.show', compact('perfil','recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view',$perfil );
        return view('perfiles.edit',compact('perfil'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {

        $this->authorize('update',$perfil);
        $data = $request->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);




        //?verfifcar si el usuario sube una imagen
            if($request['image']){
                $ruta_imagen = $request['image']->store('upload-perfiles','public');

                $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
                $img->save();

                //dato para guardar en la bd
                $array_imagen = ['image' => $ruta_imagen];
            }
        //?guardar datos
        auth()->user()-> pagina = $data['url'];
        auth()->user()-> name = $data['nombre'];
        auth()->user()->save();

         //?Eliminar url y name de $data para que no cause error
         unset($data['url']);
         unset($data['nombre']);

        auth()->user()->perfil()->update( array_merge(//! array_merge sirve para unir varios arreglos

            $data, //*ahora solo vendra el valor de bibiografia
            $array_imagen ?? []
        ));

        //?redireccionar

        return redirect()->route('recetas.home')->with(['status' => 'Se actualizo correctamente su perfil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
