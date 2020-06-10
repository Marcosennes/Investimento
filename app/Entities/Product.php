<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;
    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'instituition_id',
        'name',
        'description',
        'index',
        'interest_rate',

    ];

    public function instituition(){     //No singular pois o produto pertence a uma instituição

        return $this->belongsTo(Instituition::class);   //belong = pertence

    }

    public function moviments()     //moviments no plural pois um produto pode possuir vários movimentos
    {
        return $this->hasMany(Moviment::class);
    }

    public function valueFromUser(User $user)
    {
        $applications = $this->moviments()->product($this)->applications()->sum('value');        
        $outflows = $this->moviments()->product($this)->outflows()->sum('value');        
        
        return $applications - $outflows;  
    }

}
