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
            'cpf'        =>'17585483496',
            'name'       =>'Maria',
            'phone'      =>'359998865',
            'birth'      =>'1975-03-03',
            'gender'     =>'F',
            'email'      =>'marii@hitl.com',
            'password'   =>env('PASSWORD_HASH') ? bcrypt('123321') : '123321',
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
