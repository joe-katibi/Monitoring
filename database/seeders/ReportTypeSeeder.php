<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_types')->insert([
            [

            'type_name'=>'Audits',
            'type_id'=>'1'

            ],
            [

            'type_name'=>'Examination',
            'type_id'=>'2'

            ]

        ]);


    }
}
