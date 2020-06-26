<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Repositories\UserRepository;
use \App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    protected $repository;
    protected $service; 

    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->repository   = $repository;
        $this->service      = $service;

    }

    public function index()
    {

        $user_permission    = Auth::user()->permission;
        $user_id            = Auth::user()->id;
        $users              = $this->repository->all();

        return view('user.index', 
        [
            'users'             => $users,
            'user_permission'   => $user_permission,
            'user_id'           => $user_id,
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        $request = $this->service->store($request->all());

        /* $usuario = $request['success'] ? $request['data'] : null; */ 

        return redirect()->route('user.index');
    }

    public function edit($user_id)
    {
        if(Auth::user()->id == $user_id)
        {
            $user = $this->repository->find($user_id);
            
            
            return view('user.edit', 
            [
                'user' => $user
            ]);
        }
        else{
            return redirect()->route('user.index');
        }
    }

    public function update($id, Request $request)
    {
        if(Auth::user()->id == $id)
        {
            $request = $this->service->update($request->all(), $id);

            /* $usuario = $request['success'] ? $request['data'] : null; */ 
    
            session()->flash('success', 
            [
                'success'  => $request['success'],
                'messages' => $request['messages']
            ]);
    
            return redirect()->route('user.index');
        }
        else
        {
            return redirect()->route('user.index');
        }
    }

    public function destroy($id)
    {
        //Move o usuário para a lixeira que o softDeletes cria
        $request = $this->repository->delete($id);


        /*
         * Força a exclusão somente dos usuários que estão na lixeira que o SoftDeletes acrescenta
         * $lixo = User::onlyTrashed()->forceDelete();
         *
         * O softDeletes é necessário nesse projeto pois os objetos a serem "excluídos" possuem um histórico
         * no sistema. Um exemplo são as movimentações.  Se um usuário investe em um produto e este deixa ded exixtir?
         * O dinheiro seria perdido? E se ele quiser saber seu histórico de transações e o histórico não conseguir buscar
         * informações de um certo produto porque ele foi removido?
         * 
         * Documentação do softDeletes: https://laravel.com/docs/5.4/eloquent
         */
        

        return redirect()->route('user.index');
    }

    public function tornarAdmin($id)
    {
        $user_permission = User::
              where('id', '=', $id)
            ->select('permission')
            ->get();


        if($user_permission[0]->permission == "app.user")
        {
            $manage_user_permission = User::
                  where('id', '=', $id)
                ->update(['permission' => 'app.admin']);
        }

        if($user_permission[0]->permission == "app.admin")
        {
            $manage_user_permission = User::
                  where('id', '=', $id)
                ->update(['permission' => 'app.user']);
        }

        return redirect()->route('user.index');
    }
}
