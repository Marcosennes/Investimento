<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserGroupsCreateRequest;
use App\Http\Requests\UserGroupsUpdateRequest;
use App\Repositories\UserGroupsRepository;
use App\Validators\UserGroupsValidator;

/**
 * Class UserGroupsController.
 *
 * @package namespace App\Http\Controllers;
 */
class UserGroupsController extends Controller
{
    /**
     * @var UserGroupsRepository
     */
    protected $repository;

    /**
     * @var UserGroupsValidator
     */
    protected $validator;

    /**
     * UserGroupsController constructor.
     *
     * @param UserGroupsRepository $repository
     * @param UserGroupsValidator $validator
     */
    public function __construct(UserGroupsRepository $repository, UserGroupsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $userGroups = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userGroups,
            ]);
        }

        return view('userGroups.index', compact('userGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserGroupsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserGroupsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $userGroup = $this->repository->create($request->all());

            $response = [
                'message' => 'UserGroups created.',
                'data'    => $userGroup->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $userGroup = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userGroup,
            ]);
        }

        return view('userGroups.show', compact('userGroup'));
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
        $userGroup = $this->repository->find($id);

        return view('userGroups.edit', compact('userGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserGroupsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserGroupsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $userGroup = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'UserGroups updated.',
                'data'    => $userGroup->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'UserGroups deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UserGroups deleted.');
    }
}
