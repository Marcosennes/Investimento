<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = true;
    protected $table = 'users';
    protected $fillable = [
        'cpf',
        'name',
        'phone',
        'birth',
        'gender',
        'notes',
        'email',
        'password',
        'status',
        'permission'
    ];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups(){       //O nome é groups pois mostra todos os grupos em que esse usuário está
                                    //Tem que ser no plural pq o usuário pode estar em mais de um grupo
        //Relacionamento N:N
        return $this->belongsToMany(Group::class, 'user_groups');   //tabela que gera o apoio pra esse relacionamento
                                                                    // O laravel identifica as chaves que vão realizar o auxílio.
                                                                    // Caso o nome das tabelas esteja diferente do padrão devem ser especidifados depois dos atributos
    }

   public function moviments()
   {
       return $this->hasmany(Moviment::class);
   } 

    public function getFormattedCpfAttribute(){

        $cpf = $this->attributes['cpf'];
        return substr($cpf,0, 3) . '.' . substr($cpf,3, 3) . '.' . substr($cpf,6, 3) . '-' . substr($cpf, -2);
    }

    
    public function getFormattedPhoneAttribute(){
        
        $phone = $this->attributes['phone'];
        
        return "(" . substr($phone,0,2) . ")" . substr($phone,2,5) . "-" . substr($phone,7,4); 
    }

    public function getFormattedBirthAttribute(){

        $birth = explode('-', $this->attributes['birth']);

        if(count($birth) != 3)
            return "";

        $birth = $birth[2] . "/" . $birth[1] . "/" . $birth[0];

        return $birth;
    }
}
    