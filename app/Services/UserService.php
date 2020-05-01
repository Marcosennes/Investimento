<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Database\QueryException;
use Prettus\Validator\Contracts\ValidatorInterface;

class UserService{
    
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository,UserValidator $validator){

        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data){
        try{

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $usuario = $this->repository->create($data);

            return [
                'success'  => 'true',
                'messages' => "Usuário cadastrado",
                'data'=> $usuario,
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
    public function update(){

        
    }

    public function destroy($user_id){

        try{

            $this->repository->delete($user_id);

            return [
                'success'  => 'true',
                'messages' => "Usuário removido",
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