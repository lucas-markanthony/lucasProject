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
        DB::table('gradeSection')->insert([
            'grade' => '7',
            'section' => 'Diamond'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '7',
            'section' => 'Emerald'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '7',
            'section' => 'Jade'
        ]);
        //------------------------
        DB::table('gradeSection')->insert([
            'grade' => '8',
            'section' => 'Pearl'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '8',
            'section' => 'Star Sapphire'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '8',
            'section' => 'turquoise'
        ]);
         //------------------------
        DB::table('gradeSection')->insert([
            'grade' => '9',
            'section' => 'moonstone'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '9',
            'section' => 'garnet'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '9',
            'section' => 'onyx'
        ]);
         //------------------------
         DB::table('gradeSection')->insert([
            'grade' => '10',
            'section' => 'aquamarine'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '10',
            'section' => 'fire opal'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '10',
            'section' => 'topaz'
        ]);
         //------------------------
         DB::table('gradeSection')->insert([
            'grade' => '11',
            'section' => 'STEM_11'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '11',
            'section' => 'HUMM_11'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '11',
            'section' => 'ACT_11'
        ]);
         //------------------------
         DB::table('gradeSection')->insert([
            'grade' => '12',
            'section' => 'STEM_12'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '12',
            'section' => 'HUMM_12'
        ]);
        DB::table('gradeSection')->insert([
            'grade' => '12',
            'section' => 'ACT_12'
        ]);


        DB::table('schoolyear')->insert([
            'schoolyear' => '2021-2022'
        ]);
        DB::table('schoolyear')->insert([
            'schoolyear' => '2022-2023'
        ]);
        DB::table('schoolyear')->insert([
            'schoolyear' => '2023-2024'
        ]);
        DB::table('schoolyear')->insert([
            'schoolyear' => '2024-2025'
        ]);
        DB::table('schoolyear')->insert([
            'schoolyear' => '2025-2026'
        ]);
        DB::table('schoolyear')->insert([
            'schoolyear' => '2026-2027'
        ]);
        DB::table('schoolyear')->insert([
            'schoolyear' => '2027-2028'
        ]);


    }
}
