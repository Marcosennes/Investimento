<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        
        //$user_list = $this->userRepository->selectBoxList();              // Trás somente id => nome
        //$user_list = User::pluck('name', 'id')->all();                    // Trás somente id => nome
        $user_list = DB::table('users')->select('id', 'name')->get();       //Lembrar de importar DB. Funciona parecido com uma consulta de select, from , where. Table faz o papel do from
        $instituition_list = DB::table('instituitions')->select('id', 'name')->get();

        return view('admin.index', [

            'user_list'         => $user_list,
            'instituition_list' => $instituition_list,
        ]);
    }}
