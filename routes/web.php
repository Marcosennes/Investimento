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

Route::get('moviment', ['uses' =>'MovimentsController@application', 'as' => 'moviment.application']);
Route::post('moviment', ['uses' => 'MovimentsController@storeApplication', 'as' => 'moviment.application.store']);
Route::get('moviment/all', ['uses' => 'MovimentsController@all', 'as' => 'moviment.all']);
/*
 * O tipo da rota a seguir tem que ser any pois na paginação há um conflito entre requisições get e post
 * Vamos supor uma situação: Utilizamos o filtro em um produto e apertamos o botao(post).
 * Na primeira página pós filtrar, como  os dados vieram na requisição post nao tem problema
 * já quando clicarmos no link pra segunda pagina na interface de paginação, será uma requisição get 
 * dessa forma os dados a serem filtrados não serão enviados para a nova view.
 * é criada uma variavel dataForm no searchMoviments em movimentsController que será acionada somente a partir
 * do segundo link da paginação. 
 * Dessa forma e com a rota definida como any, a variável é acionada com os dados do filtro
 */
Route::any('moviment/search', ['uses' => 'MovimentsController@searchMoviments', 'as' => 'moviment.search']);
Route::get('getback', ['uses' => 'MovimentsController@getback', 'as' => 'moviment.getback']);
Route::post('getback', ['uses' => 'MovimentsController@storeGetback', 'as' => 'moviment.getback.store']);
/*
 * O início dessa rota possui "user". Temos que ter cuidado pois existe Route::resource pra "user"
 * Com isso, a rota "user/moviment" teve de vir antes do resource para não cair no mesmo
 * Caso fosse declarada após o resource, seria retornado um erro
 */
Route::get('user/moviment', ['uses' => 'MovimentsController@index', 'as' => 'moviment.index']);

Route::resource('user', 'UsersController');
Route::resource('instituition', 'InstituitionsController');
/*
 * Trabalhamos dessa forma quando temos um escopo dentro de outro
 * Use route:list pra ver como ficou o direcionamento das rotas
 * Cada view de produto é chamada com o id da sua instituição e seu id no link
 */
Route::resource('instituition.product', 'ProductsController'); 


Route::resource('group', 'GroupsController');

Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);