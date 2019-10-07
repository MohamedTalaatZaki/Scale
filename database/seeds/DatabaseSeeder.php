<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(MainMenusTableSeeder::class);
//        $this->call(MenuGroupsTableSeeder::class);
//        $this->call(SubMenusTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
//        $this->call(PermissionRoleTableSeeder::class);
//        $this->call(RoleUserTableSeeder::class);
        $this->call(GovSeeders::class);
        $this->call(ItemTypeSeeder::class);
        $this->call(TrucksTypesSeeder::class);

    }
}
