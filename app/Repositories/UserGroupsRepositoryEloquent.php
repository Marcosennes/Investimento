<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\User_groupsRepository;
use App\Entities\UserGroups;
use App\Validators\UserGroupsValidator;

/**
 * Class UserGroupsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserGroupsRepositoryEloquent extends BaseRepository implements UserGroupsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserGroups::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserGroupsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
