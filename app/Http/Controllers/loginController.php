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

        if($register['confirm_validation'] == false)
        {
            session()->flash('email_fail', [
                'messages' => $register['messages']
            ]);            

            return redirect()->route('login.loginPage');
        }
        else
        {
            $user = $this->repository->findWhere(['email' => $request->get('email')])->first();
            Auth::login($user);
            
            return redirect()->route('user.index');
        }
    }
}