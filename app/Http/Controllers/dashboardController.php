<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Exception;

class DashboardController extends Controller
{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    public function auth(Request $request)
    {
        $data= [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        try
        {
            /* 
            //Com criptografia de senha
            Auth::attempt($data, false);
            */

            //Sem criptografia de senha
                $user = $this->repository->findWhere(['email' => $request->get('email')])->first();

                if(!$user){
                    throw new Exception("Email informado é inválido.");
                }

                if($user->password != $request->get('password')){
                    throw new Exception(" A senha informada é inválida. ");
                }

                Auth::login($user);

            return redirect()->route('user.index');
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
}
