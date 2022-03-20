<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'titulo','ingredientes','preparacion','imagen','categoria_id'
    ];

    public function categoria(){
        return $this->belongsTo(CategoriasReceta::class);
    }
    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');//?FK de esta tabla
    }

   //?relacion de muchos a muchos
    public function likesRecibidos(){
       // *se le tiene que pasar la tabla pibote con las tablas a relacionar
        return $this->belongsToMany(User::class,'likes','receta_id','user_id');
    }
}
