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
            'cpf'        => '17498483496',
            'name'       => 'Janir',
            'phone'      => '359428865',
            'birth'      => '1978-03-03',
            'gender'     => 'F',
            'email'      => 'janir@gmail.com',
            'password'   => password_hash('123321', PASSWORD_DEFAULT),
            'permission' => 'app.admin',
        ]);
        // $this->call(UsersTableSeeder::class);

        // php artisan db:seed comando para efetivar a seed
    }
}
