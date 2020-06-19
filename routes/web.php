<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/',           ['uses' => 'loginController@fazerLogin', 'as'    => 'login.loginPage']);
Route::post('/login',     ['uses' => 'dashboardController@auth', 'as'      =>'dashboard.auth']);
Route::post('/registrar', ['uses' => 'loginController@registrar', 'as'     => 'login.register']);


Route::group(['middleware' => 'auth.login'], function() {

       /*
        * O início dessa rota possui "user". Temos que ter cuidado pois existe Route::resource pra "user"
        * Com isso, a rota "user/moviment" teve de vir antes do resource para não cair no mesmo
        * Caso fosse declarada após o resource, seria retornado um erro
        */

        Route::get('user/moviment', ['uses' => 'MovimentsController@index', 'as' => 'moviment.index']);

        Route::group(['middleware' => 'auth.permission'], function() {

                Route::get('/dashboard', ['uses'=> 'AdminController@index', 'as'=>'user.dashboard']); 

                Route::resource('group', 'GroupsController');
                Route::get('/trashed_groups', ['uses' => 'GroupsController@trash', 'as' => 'group.trash']);
                Route::get('group/{group_id}/restore', ['uses' => 'GroupsController@restore', 'as' => 'group.restore']);
                Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);

                Route::resource('user', 'UsersController');

                //A rota precisa ser declarada por fora do resource e tem que ser get pois a variável que a mesma envia é através da url.
                Route::get('/user/{user_id}/tornarAdmin', ['uses' => 'UsersController@tornarAdmin', 'as' => 'user.tornarAdmin']);

                Route::resource('instituition', 'InstituitionsController');
                Route::get('/trashed_instituitions', ['uses' => 'InstituitionsController@trash', 'as' => 'instituition.trash']);
                Route::get('instituition/{instituition_id}/restore', ['uses' => 'InstituitionsController@restore', 'as' => 'instituition.restore']);
        
        });

        Route::resource('group', 'GroupsController', [
        'only' => ['index', 'show'],
        ]);

        Route::resource('user', 'UsersController', [
        'only' => ['index', 'edit', 'update'],
        ]);

        Route::resource('instituition', 'InstituitionsController', [
        'only' => ['index', 'show'],
        ]);

        Route::get('moviment/all', ['uses' => 'MovimentsController@all', 'as' => 'moviment.all']);
        Route::get('moviment', ['uses' =>'MovimentsController@application', 'as' => 'moviment.application']);
        Route::post('moviment', ['uses' => 'MovimentsController@storeApplication', 'as' => 'moviment.application.store']);
        
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
        * Trabalhamos dessa forma quando temos um escopo dentro de outro
        * Use route:list pra ver como ficou o direcionamento das rotas
        * Cada view de produto é chamada com o id da sua instituição e seu id no link
        */
        
        Route::resource('instituition.product', 'ProductsController'); 

        Route::get('/logout', function()
        {
        Auth::logout();

        return view('user.login');
        })->name('logout');
});

