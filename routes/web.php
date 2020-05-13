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



Route::get('/', ['uses'=> 'loginController@fazerLogin']);
Route::post('/login', ['uses'=> 'dashboardController@auth', 'as'=>'user.login']);
Route::get('/dashboard', ['uses'=> 'dashboardController@index', 'as'=>'user.dashboard']);

Route::resource('user', 'UsersController');
Route::resource('instituition', 'InstituitionsController');

Route::resource('instituition.product', 'ProductsController'); 

/*
 * Trabalhamos dessa forma quando temos um escopo dentro de outro
 * Use route:list pra ver como ficou o direcionamento das rotas
 * Cada view de produto é chamada com o id da sua instituição e seu id no link
 */
Route::get('moviment', ['uses' =>'MovimentsController@application', 'as' => 'moviment.application']);

Route::resource('group', 'GroupsController');

Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);