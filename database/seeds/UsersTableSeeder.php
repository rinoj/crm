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
            'name' => 'Jimmy',
            'email' => 'test@gmail.com',
            'password' => bcrypt('Kosova123.'),
        ]);
        DB::table('users')->insert([
            'name' => 'Kevin',
            'email' => 'kevin@gmail.com',
            'password' => bcrypt('Kosova123.'),
        ]);
        DB::table('users')->insert([
            'name' => 'Matthew',
            'email' => 'matthew@gmail.com',
            'password' => bcrypt('Kosova123.'),
        ]);
        DB::table('users')->insert([
            'name' => 'Ron',
            'email' => 'ron@gmail.com',
            'password' => bcrypt('Kosova123.'),
        ]);
        DB::table('users')->insert([
            'name' => 'Aaron',
            'email' => 'aaron@gmail.com',
            'password' => bcrypt('Kosova123.'),
        ]);
    }
}
