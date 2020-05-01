<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Group.
 *
 * @package namespace App\Entities;
 */
class Group extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name',
        'user_id',
        'instituition_id',

    ];

    public function owner()                     // Define um relacionamento de Grupo com Usuário
    {
        return $this->belongsTo(User::class);   // O Grupo pertence a um usuário 

                                                //Quando tiver um objeto do tipo Group, podemos acessar por exemplo quem seria o usuário relacionado com $group->owner->name
    }

    public function instituition(){

        return $this->belongsTo(Instituition::class);

    }

}
