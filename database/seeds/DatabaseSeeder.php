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
        $this->call(RolesPermissionSeeder::class);
        $this->call(OutcomeTableSeeder::class);
        $this->call(LeadsTableSeeder::class);
    }
}
