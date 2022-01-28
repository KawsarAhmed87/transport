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
        $this->call(DivisionSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(RoleAssignSeeder::class);

    }
}
