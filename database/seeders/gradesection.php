<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class gradesection extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjectGroup')->insert([
            'name' => '2021-2022_JUNIOR_HIGH',
            'subjectgroup' => 'ENGLISH|MATH|SCIENCE|TLE|MAPEH'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => '2021-2022_SENIOR_HIGH_STEM',
            'subjectgroup' => 'ENGLISH|MATH|SCIENCE|TLE|MAPEH'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => '2021-2022_SENIOR_HIGH_ABM',
            'subjectgroup' => 'ENGLISH|MATH|SCIENCE|TLE|MAPEH'
        ]);

    }
}
