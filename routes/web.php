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

Route::get('/', ['as' => 'home', function () {
    return view('welcome');
}]);

Route::get('home', function () {
    $data = array(
        'nombre' => 'Mi nombre'
    );
    return view('home', $data);
});

Route::get('/contacto', function () {
    return 'Hola desde contacto';
});

Route::get('/saludo/{nombre}', ['as' => 'saludo', function ($nombre) {
    return 'Saludos para ' . $nombre;
}]);

Route::get('/saludo2/{nombre?}', function ($nombre = 'Invitado') {
    return 'Saludos para ' . $nombre;
});

Route::get('/cuadrado/{numero}', function ($numero) {
    return $numero * $numero;
})->where('numero', "[0-9]+");

Route::get('enlace', [ 'as' => 'enlace', function () {
    return 'Enlace';
}]);

Route::get('/enlace/render', function () {
    echo('<a href="' . route('enlace') . '">Enlace</a>');
    echo('<a href="' . route('enlace') . '">Enlace</a>');
    echo('<a href="' . route('enlace') . '">Enlace</a>');
    echo('<a href="' . route('enlace') . '">Enlace</a>');
    echo('<a href="' . route('enlace') . '">Enlace</a>');
});


Route::resource('messages', 'MessagesController');
/*Route::get('messages', [ 'as' => 'messages.index', 'uses' => 'MessagesController@index']);
Route::get('messages/{id}', [ 'as' => 'messages.show', 'uses' => 'MessagesController@show'])->where('id', "[0-9]+");
Route::get('messages/create', [ 'as' => 'messages.create', 'uses' => 'MessagesController@create']);
Route::post('messages', [ 'as' => 'messages.store', 'uses' => 'MessagesController@store']);
Route::get('messages/{id}/edit', [ 'as' => 'messages.edit', 'uses' => 'MessagesController@edit']);
Route::put('messages/{id}', [ 'as' => 'messages.update', 'uses' => 'MessagesController@update']);
Route::delete('messages/{id}', [ 'as' => 'messages.destroy', 'uses' => 'MessagesController@destroy']);*/