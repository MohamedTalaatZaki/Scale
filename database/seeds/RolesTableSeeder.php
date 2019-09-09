<?php

use App\Models\Roles\Permission;
use App\Models\Roles\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('roles')->delete();
        DB::table('role_user')->delete();
        DB::table('permission_role')->delete();

        $roleAdmin = Role::create([
            'name' => 'Admin',
            'display_name' => NULL,
            'description' => NULL,
            'is_active' => 1,
            'is_admin'=>1
        ]);

        $adminUser = User::where('is_admin',1)->pluck('id');
        $roleAdmin->users()->sync($adminUser->all());
        $permissions = Permission::pluck('id')->all();
        $roleAdmin->perms()->sync($permissions);

        
        
    }
}