<?php

use Illuminate\Database\Seeder;

class OutcomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('outcomes')->insert([
            'name' => 'Not Called',
            'abbr' => 'NC',
        ]);
        DB::table('outcomes')->insert([
            'name' => 'Needs to be Contacted',
            'abbr' => 'NBC',
        ]);
        DB::table('outcomes')->insert([
            'name' => 'No Answer',
            'abbr' => 'NA',
        ]);
        DB::table('outcomes')->insert([
            'name' => 'Wrong Number',
            'abbr' => 'WN',
        ]);
        DB::table('outcomes')->insert([
            'name' => 'Invalid Number',
            'abbr' => 'IN',
        ]);
    }
}
