<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('summaries')->insert([
            [

            'summary_title'=>'Strength Summary            ',
            'summary_name'=>'Customer education',
            'service_id'=>'1'

            ],
            [

            'summary_title'=>'Strength Summary            ',
            'summary_name'=>'call personalization',
            'service_id'=>'1'

            ]
            ,
            [

            'summary_title'=>'Strength Summary            ',
            'summary_name'=>'Offer Further Assistance',
            'service_id'=>'1'

            ]
    ]);
    }
}
