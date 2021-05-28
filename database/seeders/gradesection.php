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
            'name' => 'DEFAULT_JUNIOR_HIGH',
            'subjectgroup' => 'FILIPINO|ENGLISH|MATHEMATICS|SCIENCE|ARALING_PANLIPUNAN|EDUKASYON_SA_PAGKATAO|TECHNOLOGY_AND_LIVELIHOOD_EDUCATION_WITH_COMPUTER|MAPEH|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_STEM_11_1ST_SEM',
            'subjectgroup' => 'OCIC|KPWKP|GENERAL_MATHEMATICS|EARTH_SCIENCE|21CLPW|PE1|ET|PFPL|PRE_CALCULUS|GENERAL_BIOLOGY_1|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_STEM_11_2ND_SEM',
            'subjectgroup' => 'RWS|PPIITTP|STATISTICS_AND_PROBABILITY|DRRR|PEROSONAL_DEVELOPMENT|PE2|RESEARCH_IN_DAILY_LIFE_1|ENTREPRENEURSHIP|BASIC_CALCULUS|GENERAL_BIOLOGY_2|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_STEM_12_1ST_SEM',
            'subjectgroup' => 'IPHP|CPAR|UCSP|PE3|EAPP|GENERAL_PHYSICS_1|GENERAL_CHEMISTRY_1|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_STEM_12_2ND_SEM',
            'subjectgroup' => 'MIL|PE4|RESEARCH_PROJECT|GENERAL_PHYSICS_2|GENERAL_CHEMISTRY_2|CAPSTONE_PROJECT|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_HUMMS_11_1ST_SEM',
            'subjectgroup' => 'OCC|KPWKP|GENERAL_MATHEMATICS|ELS|21CLPW|PE1|ET|PFPL|PPG|DISS|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_HUMMS_11_2ND_SEM',
            'subjectgroup' => 'RWS|PPIITTP|STATISTICS_AND_PROBABILITY|PHYSICAL_SCIENCE|PERSONAL_DEVELOPMENT|PE2|RDL1|ENTREPRENEURSHIP|IWRBS|DIASS|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_HUMMS_12_1ST_SEM',
            'subjectgroup' => 'IPHP|CPAR|UCSP|PE3|EAPP|RDL2|CESC|CW/MP|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_HUMMS_12_2ND_SEM',
            'subjectgroup' => 'MIL|PE4|RESEARCH_PROJECT|TNCT21CC|CNFTLE|CULMINATING_ACTIVITY|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_ABM_11_1ST_SEM',
            'subjectgroup' => 'OCC|KPWKP|GENERAL_MATHEMATICS|ELS|21CLPW|PE1|ET|PFPL|ORGANIZATION_AND_MANAGEMENT|BUSINESS_MATH|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_ABM_11_2ND_SEM',
            'subjectgroup' => 'RWS|PPIITTP|STATISTICS_AND_PROBABILITY|PHYSICAL_SCIENCE|PERSONAL_DEVELOPMENT|PE2|RDL1|ENTREPRENEURSHIP|FABM1|BUSINESS_MARKETING|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_ABM_12_1ST_SEM',
            'subjectgroup' => 'IPHP|CPAR|UCSP|PE3|EAPP|RDL2|FCBM2|APPLIED_ECONOMICS|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_ABM_12_2ND_SEM',
            'subjectgroup' => 'MIL|PE4|RESEARCH_PROJECT|BUSINESS_FINANCE|BESR|BES|HOMEROOM_GUIDANCE'
        ]);
        
        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_TVL_11_1ST_SEM',
            'subjectgroup' => 'OCC|KPWKP|GENERAL_MATHEMATICS|ELS|21CLPW|PE1|EMPOWERMENT_TECHNOLOGIES|PFPL|EIM|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_TVL_11_2ND_SEM',
            'subjectgroup' => 'RWS|PPIITTP|STATISTICS_AND_PROBABILITY|PHYSICAL_SCIENCE|PERSONAL_DEVELOPMENT|PE2|RDL1|ENTREPRENEURSHIP|EIM|HOMEROOM_GUIDANCE'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_TVL_12_1ST_SEM',
            'subjectgroup' => 'IPHP|CPAR|UCSP|PE3|EAPP|RDL2|EIM|HOMEROOM_GUIDANCe'
        ]);

        DB::table('subjectGroup')->insert([
            'name' => 'DEFAULT_SENIOR_HIGH_TVL_12_2ND_SEM',
            'subjectgroup' => 'MIL|PE4|III|EIM|WORK_IMMERSION|HOMEROOM_GUIDANCE'
        ]);
    }
}
