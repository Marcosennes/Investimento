<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
            'email'     => $request->get('email'),
            'password'  => $request->get('password'),
        ];

        try
        {
            //Com criptografia de senha
                //Auth::attempt($data, false);
                $user = $this->repository->findWhere(['email' => $request->get('email')])->first();
                
                if(!$user)
                {
                    session()->flash('none_user', [
                        'messages' => "Usuário não existe no sistema"
                    ]);

                    return redirect()->route('login.loginPage');
                }
                else{

                    //dd($request->get('password'), $user->password);
                    //dd(password_verify($request->get('password'), $user->password));
                    if(password_verify($request->get('password'), $user->password))
                    {
                        Auth::login($user);
                        
                        return redirect()->route('user.index');
                    }
                    else
                    {
                        session()->flash('wrongPassword', [
                            'messages' => "A senha informada não corresponde ao e-mail cadastrado no sistema",
                        ]);

                        return redirect()->route('login.loginPage');
                    }
                }

            //Sem criptografia de senha
                /*
                $user = $this->repository->findWhere(['email' => $request->get('email')])->first();

                if(!$user){
                    throw new Exception("Email informado é inválido.");
                }

                dd($user->password, $request->get('password'));
                if($user->password != $request->get('password')){
                    throw new Exception(" A senha informada é inválida. ");
                }
                Auth::login($user);
                */

            return redirect()->route('user.index');
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
}
