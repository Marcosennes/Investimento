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

    public function store(array $data) :array
    {
        try{

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $group = $this->repository->create($data);

            return [
                'success'  => 'true',
                'messages' => "Grupo cadastrado",
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

    public function update($data, $id){
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $group = $this->repository->update($data, $id);
            
            return [
                'success'  => 'true',
                'messages' => "Group Atualizado",
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

    public function destroy($group_id){

        try{

            $this->repository->delete($group_id);

            return [
                'success'  => 'true',
                'messages' => "Grupo removido",
                'data'=> null,
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

    public function userstore($group_id , $data){


        try{
            
            $group = $this->repository->find($group_id);
            $user_id = $data['user_id'];

            $group->users()->attach($user_id);

            return [
                'success'  => 'true',
                'messages' => "Usuário relacionado",
                'data'=> null,
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