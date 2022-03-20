<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected static function boot()
    {
        parent::boot();
        static::created(function( $user ){
            $user->perfil()->create();
        });
    }


     //?relacion 1:n de usuarios a recetas
     public function resetas(){
        return $this->hasMany(Receta::class);
    }

    //?relacion de uno a uno 1:1

    public function perfil(){
        return $this->hasOne(Perfil::class);
    }


    // //?relacion de muchos a muchos
    public function likesDados(){
        return $this->belongsToMany(Receta::class,'likes','user_id','receta_id');
    }
}
