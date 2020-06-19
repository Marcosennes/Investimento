<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Instituition;
use App\Entities\Product; 
use App\Http\Requests\InstituitionCreateRequest;
use App\Repositories\InstituitionRepository;
use App\Services\InstituitionService;
use Illuminate\Support\Facades\Auth;

class InstituitionsController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(InstituitionRepository $repository, InstituitionService $service)
    {
        $this->repository   = $repository;
        $this->service      = $service;
    }

    public function index()
    {
        $user_permission    = Auth::user()->permission;
        $instituitions      = $this->repository->all();
        $type_page          = "index";

        return view('instituitions.index', 
        [
            'instituitions'     => $instituitions,
            'user_permission'   => $user_permission,
            'type_page'         => $type_page,
        ]);
    }

    public function trash()
    {
        $user_permission    = Auth::user()->permission;
        $trashed_groups     = Instituition::onlyTrashed()->get();
        $type_page          = "trash";

        return view('instituitions.index', 
        [
            'user_permission'   => $user_permission,
            'instituitions'     => $trashed_groups,
            'type_page'         => $type_page,
        ]);
    }

    public function store(InstituitionCreateRequest $request)
    {
        $request        = $this->service->store($request->all());
        $instituition   = $request['success'] ? $request['data'] : null;

        session()->flash('success', 
        [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('instituition.index');
    }

    public function restore($id)
    {
        Instituition::
              onlyTrashed()
            ->where('id', $id)->restore();

        Product::
              where('instituition_id', $id)
            ->restore ();

    return redirect()->route('instituition.index');
    }

    public function edit($id)
    {
        $instituition = $this->repository->find($id);

        return view('instituitions.edit', 
        [
            'instituition' => $instituition,
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

        return redirect()->route('instituition.index');
    }

    public function destroy($id)
    {
        Product::
              where('instituition_id', $id)
            ->delete();

        $this->repository->delete($id);

        return redirect()->route('instituition.index');
    }
}
