<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Group;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Repositories\InstituitionRepository;
use App\Repositories\UserRepository;
use App\Services\GroupService;
use App\Validators\GroupValidator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


/**
 * Class GroupsController.
 *
 * @package namespace App\Http\Controllers;
 */
class GroupsController extends Controller
{
    /**
     * @var GroupRepository
     */
    protected $userRepository;
    protected $instituitionRepository;
    protected $repository;

    /**
     * @var GroupValidator
     */
    protected $validator;
    protected $service;


    /**
     * GroupsController constructor.
     *
     * @param GroupRepository $repository
     * @param GroupValidator $validator
     */
    public function __construct(GroupRepository $repository, GroupValidator $validator, GroupService $service, InstituitionRepository $instituitionRepository, UserRepository $userRepository )
    {
        $this->repository               = $repository;
        $this->validator                = $validator;
        $this->service                  = $service;
        $this->instituitionRepository   = $instituitionRepository;
        $this->userRepository           = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_permission    = Auth::user()->permission;
        $groups             = $this->repository->all();
        $type_page          = "index";

        return view('groups.index', [
            'user_permission'   => $user_permission,
            'groups'            => $groups,
            'type_page'         => $type_page,
        ]);
    }

    public function trash()
    {
        $user_permission    = Auth::user()->permission;
        $trashed_groups     = Group::onlyTrashed()->get();
        $type_page          = "trash";

        return view('groups.index', [
            'user_permission'   => $user_permission,
            'groups'            => $trashed_groups,
            'type_page'         => $type_page,
        ]);
    }

    public function restore($id)
    {
        Group::onlyTrashed()->where('id', $id)->restore();

    return redirect()->route('group.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GroupCreateRequest $request)
    {
        $request    = $this->service->store($request->all());
        $group      = $request['success'] ? $request['data'] : null;

        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('group.index');
    }

    public function userStore(Request $request, $group_id){

        $request    = $this->service->userstore($group_id ,$request->all());

        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('group.show', [$group_id]);
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
        $user_permission = Auth::user()->permission;
        $user_list = DB::table('users')->select('id', 'name')->get();       //Lembrar de importar DB. Funciona parecido com uma consulta de select, from , where. Table faz o papel do from
        $group = $this->repository->find($id);

        return view('groups.show', [
            'group' => $group,
            'user_list' => $user_list,
            'user_permission' =>$user_permission,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group      = $this->repository->find($id);
        $user_list  = User::select('id', 'name')->get();
        return view('groups.edit', [
            'group'             => $group,
            'user_list'         => $user_list,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupUpdateRequest $request
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

        return redirect()->route('group.index');
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
        $deleted = $this->repository->delete($id);
        return redirect()->route('group.index');
    }
}
