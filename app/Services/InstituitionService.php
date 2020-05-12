<?php

namespace App\Services;

use App\Repositories\InstituitionRepository;
use App\Validators\InstituitionValidator;
use Exception;
use Illuminate\Database\QueryException;
use Prettus\Validator\Contracts\ValidatorInterface;

class InstituitionService{

    private $repository;
    private $validator;

    public function __construct(InstituitionRepository $repository, InstituitionValidator $validator){

        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function store($data){
        try{

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $instituition = $this->repository->create($data);

            return [
                'success'  => 'true',
                'messages' => "Institução cadastrada",
                'data'=> $instituition,
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
            $instituition = $this->repository->update($data, $id);

            return [
                'success'  => 'true',
                'messages' => "Instituição Atualizada",
                'data'=> $instituition,
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
    public function destroy($inst_id){

        try{

            $this->repository->delete($inst_id);

            return [
                'success'  => 'true',
                'messages' => "Instituição removida",
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