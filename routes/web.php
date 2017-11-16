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

/*DB::listen(function ($query){
    echo("<pre>({$query->time}) {$query->sql}</pre>");
});*/

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);
Route::get('/saludo/{nombre}', ['as' => 'saludo', 'uses' => 'PagesController@saludo']);

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::resource('messages', 'MessagesController');
Route::resource('users', 'UsersController');