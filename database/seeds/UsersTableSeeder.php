<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::where('user_name','admin')->first();
        if(is_null($user)){
            DB::table('users')->insert([
                'full_name'         =>  'Admin',
                'user_name'         =>  'admin',
                'employee_number'   =>  1,
                'email'             =>  'admin@admin.com',
                'password'          =>  Hash::make(123456),
                'is_active'         => 1,
                'is_admin'          =>1
            ]);
        }
    }
}
