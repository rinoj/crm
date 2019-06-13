<?php

use Illuminate\Database\Seeder;

class LeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('leads')->insert([
        //     'name' => 'John Doe',
        //     'phone' => '13479926251',
        //     'email' => 'johndoe@gmail.com',
        //     'user_id' => 1,
        //     'category_id'  => 1,
        //     'outcome_id'    =>  1,
        // ]);

        // DB::table('leads')->insert([
        //     'name' => 'Will Mugget',
        //     'phone' => '14085916251',
        //     'email' => 'willmugget@gmail.com',
        //     'user_id' => 1,
        //     'category_id'  => 2,
        //     'outcome_id'    =>  2,
        // ]);

        // DB::table('leads')->insert([
        //     'name' => 'Greg Smith',
        //     'phone' => '19876543210',
        //     'email' => 'gregsmith@gmail.com',
        //     'user_id' => 1,
        //     'category_id'  => 1,
        //     'outcome_id'    =>  3,
        // ]);

        DB::table('categories')->insert([
            'name'  =>  'United States',
            'prefix'    =>  '1',
        ]);

        DB::table('categories')->insert([
            'name'  =>  'Canada',
            'prefix'    =>  '1',
        ]);
    }
}
