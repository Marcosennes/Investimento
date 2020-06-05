<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Validators\UserValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function fazerLogin(){
        return view('user.login');
    }

    public function registrar(UserCreateRequest $request)
    {
        //dd($request->all(), $data);

        $register = $this->service->store($request->all());
        /* $usuario = $request['success'] ? $request['data'] : null; */ 

        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        $user = $this->repository->findWhere(['email' => $request->get('email')])->first();
        Auth::login($user);
        

        return redirect()->route('user.index');
    }
}