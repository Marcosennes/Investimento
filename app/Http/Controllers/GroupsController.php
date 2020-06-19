<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Group;
use Illuminate\Http\Request;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Services\GroupService;
use App\Validators\GroupValidator;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    protected $repository;
    protected $validator;
    protected $service;

    public function __construct(GroupRepository $repository, GroupValidator $validator, GroupService $service )
    {
        $this->repository               = $repository;
        $this->validator                = $validator;
        $this->service                  = $service;
    }

    public function index()
    {
        $user_permission    = Auth::user()->permission;
        $groups             = $this->repository->all();
        $type_page          = "index";

        return view('groups.index', 
        [
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

        return view('groups.index', 
        [
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

    public function store(GroupCreateRequest $request)
    {
        $request    = $this->service->store($request->all());
        $group      = $request['success'] ? $request['data'] : null;

        $this->service->userstore($group->id, $group['user_id']);

        session()->flash('success', 
        [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('group.index');
    }

    public function userStore(Request $request, $group_id){
        $request    = $this->service->userstore($group_id ,$request->get('user_id'));

        session()->flash('success', 
        [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('group.show', [$group_id]);
    }

    public function show($id)
    {
        $user_permission    = Auth::user()->permission;
        $user_id            = Auth::user()->id;
        $user_list          = User::select('id', 'name')->get();
        $group              = $this->repository->find($id);

        return view('groups.show', 
        [
            'group'             => $group,
            'user_list'         => $user_list,
            'user_permission'   =>$user_permission,
            'user_id'           => $user_id,
        ]);
    }

    public function edit($id)
    {
        $group      = $this->repository->find($id);
        $user_list  = User::select('id', 'name')->get();

        return view('groups.edit',
        [
            'group'     => $group,
            'user_list' => $user_list,
        ]);
    }

    public function update($id, Request $request)
    {

        $request = $this->service->update($request->all(), $id);

        /* $usuario = $request['success'] ? $request['data'] : null; */ 

        session()->flash('success', 
        [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('group.index');
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        
        return redirect()->route('group.index');
    }
}
