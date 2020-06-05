<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cpf'        => '17585483496',
            'name'       => 'Maria',
            'phone'      => '359998865',
            'birth'      => '1975-03-03',
            'gender'     => 'F',
            'email'      => 'maria@gmail.com',
            'password'   => env('PASSWORD_HASH') ? bcrypt('123321') : '123321',
            'permission' => 'app.admin',
        ]);
        User::create([
            'cpf'        => '14575483496',
            'name'       => 'Paulo',
            'phone'      => '359438865',
            'birth'      => '1964-03-03',
            'gender'     => 'M',
            'email'      => 'paulo@gmail.com',
            'password'   => '123321',
            'permission' => 'app.admin',
        ]);

        // $this->call(UsersTableSeeder::class);

        // php artisan db:seed comando para efetivar a seed
    }
}
