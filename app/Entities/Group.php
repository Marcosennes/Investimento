<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Group.
 *
 * @package namespace App\Entities;
 */
class Group extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
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

    public function getTotalValueAttribute(){

        /*
        $total = 0;
        foreach($this->moviments as $moviment){

            $total += $moviment->value;
        }        
        return $total;        
        */

        return $this->moviments->where('type', 1)->sum('value') - $this->moviments->where('type', 2)->sum('value');
        //ou
        //$this->moviments()->applications()->sum('value') - $this->moviments()->outflows->sum('value');

    }

    public function user()                                  // Define um relacionamento de Grupo com Usuário
    {
        return $this->belongsTo(User::class, 'user_id');    // se o nome da função for o mesmo da tabela( nesse caso user é nome da função e da tabela ),
                                                            //não é necessário o segundo parâmetro de belongsTo ( 'user_id' )
                                                            //Se o nome da função for difernte da tabela esse campo é necessário para definir a tabela que vai fazer o relacionamento
                                                            //Quando tiver um objeto do tipo Group, podemos acessar por exemplo quem seria o usuário relacionado com $group->user->name
    }

    public function users(){    //o nome é users pois mostra todos os usuários que estao nesse grupo
        
        //Relacionamento N:N
        return $this->belongsToMany(User::class, 'user_groups');    //tabela que gera o apoio pra esse relacionamento
    }

    public function moviments()
    {
        return $this->hasMany(Moviment::class);
    }

}
