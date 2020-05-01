<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Exception;
use Illuminate\Database\QueryException;
use Prettus\Validator\Contracts\ValidatorInterface;

class GroupService{

    private $repository;
    private $validator;

    public function __construct(GroupRepository $repository, GroupValidator $validator){

        $this->repository   = $repository;
        $this->validator    = $validator;

    }

    public function store($data){
        try{

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $group = $this->repository->create($data);

            return [
                'success'  => 'true',
                'messages' => "Grupo cadastrada",
                'data'=> $group,
            ];
        }
        catch(Exception $e){

            switch(get_class($e)){
                
                case QueryException::class     : return ['success' => false, 'messages' => $e->getMessage()];
                case Exception::class          : return ['success' => false, 'messages' => $e->getMessage()];
                default                        : return ['success' => false, 'messages' => get_class($e)];
            }
        }
    }

}