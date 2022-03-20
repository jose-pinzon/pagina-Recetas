<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//!buscador recetas
Route::get('/buscar', 'RecetaController@search')->name('buscar.search');



Route::get('/','InicioController@index')->name('inicio.index');

Route::get('/recetas', 'RecetaController@index')->name('recetas.home');
Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create');
Route::post('/create','RecetaController@store')->name('recetas.store');
Route::get('/recetas/{receta}','RecetaController@show')->name('recetas.show');
Route::get('/recetas/{receta}/edit','RecetaController@edit')->name('recetas.edit');
Route::put('/recetas/{receta}','RecetaController@update')->name('recetas.update');
Route::delete('/recetas/{receta}','RecetaController@destroy')->name('recetas.destroy');

Route::get('/categoria/{categoriaReceta}','CategoriaController@show')->name('categorias.show');



Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfil.show');
Route::get('/perfiles/{perfil}/edit','PerfilController@edit')->name('perfil.edit');
Route::put('/perfiles/{perfil}','PerfilController@update')->name('perfil.update');


Route::post('/likes/{receta}','LikeController@update')->name('likes.update');
Auth::routes();


