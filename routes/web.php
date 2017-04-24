<?php

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::group(['middleware' => 'cors'], function(){
	Route::post('login', 'ApiController@authenticate');
});

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['before' => 'cors']], function () {

	#Marca
	    Route::get('marcas', 'MarcaController@getMarca' );
	    Route::post('marcas/save', 'MarcaController@save' );
	    Route::post('marcas/update', 'MarcaController@update' );
	    Route::post('marcas/update/estado', 'MarcaController@updateEstado' );

});
