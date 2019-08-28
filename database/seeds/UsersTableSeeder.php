<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'                =>  1,
            'full_name'         =>  'Admin',
            'user_name'         =>  'admin',
            'employee_number'   =>  1,
            'email'             =>  'admin@admin.com',
            'password'          =>  Hash::make(123456),
        ]);
    }
}
