<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', ['uses'=> 'loginController@fazerLogin']);
Route::post('/login', ['uses'=> 'dashboardController@auth', 'as'=>'user.login']);
Route::get('/dashboard', ['uses'=> 'dashboardController@index', 'as'=>'user.dashboard']);

Route::resource('user', 'UsersController');
Route::resource('instituition', 'InstituitionsController');
Route::resource('group', 'GroupsController');