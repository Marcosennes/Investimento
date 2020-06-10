<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserGroups.
 *
 * @package namespace App\Entities;
 */
class UserGroups extends Model implements Transformable
{
    use TransformableTrait;


    protected $table = 'user_groups';
    protected $fillable = [
        
        'id',
        'user_id',
        'group_id',
    ];

}
