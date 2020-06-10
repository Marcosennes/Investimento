<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use \App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;
    protected $service; 

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->repository = $repository;
        $this->service = $service;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_permission = Auth::user()->permission;
        $users = $this->repository->all();

        return view('user.index', [
            'users' => $users,
            'user_permission' => $user_permission,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserCreateRequest $request)
    {

        $request = $this->service->store($request->all());
        /* $usuario = $request['success'] ? $request['data'] : null; */ 

        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = $this->repository->find($user_id);

        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, Request $request)
    {

        $request = $this->service->update($request->all(), $id);
        /* $usuario = $request['success'] ? $request['data'] : null; */ 

        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('user.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Move o usuário para a lixeira que o softDeletes cria
        $request = $this->repository->delete($id);

        //Força a exclusão somente dos usuários que estão na lixeira que o SoftDeletes acrescenta
        //$lixo = User::onlyTrashed()->forceDelete();

        /*
         * O softDeletes é necessário nesse projeto pois os objetos a serem "excluídos" possuem um histórico
         * no sistema. Um exemplo são as movimentações.  Se um usuário investe em um produto e este deixa ded exixtir?
         * O dinheiro seria perdido? E se ele quiser saber seu histórico de transações e o histórico não conseguir buscar
         * informações de um certo produto porque ele foi removido?
         */
        
        //Documentação do softDeletes: https://laravel.com/docs/5.4/eloquent

        return redirect()->route('user.index');
    }

    public function tornarAdmin($id)
    {
        $user_permission = DB::table('users')
                            ->where('id', '=', $id)
                            ->select('permission')
                            ->get();


        if($user_permission[0]->permission == "app.user")
        {
            $manage_user_permission = DB::table('users')
                                        ->where('id', '=', $id)
                                        ->update(['permission' => 'app.admin']);
        }
        if($user_permission[0]->permission == "app.admin")
        {
            $manage_user_permission = DB::table('users')
                                        ->where('id', '=', $id)
                                        ->update(['permission' => 'app.user']);
        }

        return redirect()->route('user.index');
    }
}
