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

//https://learnku.com/docs/laravel/6.x/routing/5135#basic-routing
Route::get('/gbook/index', 'MsgController@index');
Route::post('/gbook/save', 'MsgController@save');