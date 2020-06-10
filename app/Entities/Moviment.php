<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Moviment.
 *
 * @package namespace App\Entities;
 */
class Moviment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'group_id',
        'product_id',
        'value',
        'type',
    ];

    public function user(){
        return $this->belongsTo(User::class); 
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function scopeProduct($query, $product){   //Investir dinheiro
        return $query->where('product_id', $product->id);
    }
    
    public function scopeApplications($query){   //Investir dinheiro
        return $query->where('type', 1);
    }

    public function scopeOutflows($query){   //Retirada de dinheiro
        return $query->where('type', 2);
    }
    public function search(Array $data, $totalPage)
    {
        $user_id = Auth::id();
        $products = $this
                        ->join('products', function($join)
                        {
                            $join->on('moviments.product_id', '=', 'products.id');
                        })
                        ->join('groups', function($join)
                        {
                            $join->on('moviments.group_id', '=', 'groups.id');
                        })
                        ->where(function($query) use($data, $user_id){

                            $query->where('moviments.user_id', '=', $user_id);
                            if(isset($data['product_name']))
                            {
                                $query->where('products.name', '=', $data['product_name']);
                            }
                            if(isset($data['group_name']))
                            {
                                $query->where('groups.name', '=', $data['group_name']);
                            }
                        })
                        ->paginate(11);
        return $products;
    }

    public function listar()
    {
        $id_user = Auth::id();

        $moviment_list = $this
                            ->where('user_id', '=', $id_user)
                            ->select('*')
                            ->Paginate(11);        

        foreach($moviment_list as $moviment)
        {
            $produto = Product::withTrashed()
                            ->where('id', '=', $moviment->attributes['product_id'])
                            ->select('name')
                            ->get();

            $moviment->attributes['product_name'] = $produto[0]->attributes['name'];
        }

        return $moviment_list;
    }

}
