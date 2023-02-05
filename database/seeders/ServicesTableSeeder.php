<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [

            'service_name'=>'Cable',
            'service_id'=>'1'

            ],
            [

                'service_name'=>'DTH',
                'service_id'=>'2'

            ]
            ,
            [

                'service_name'=>'Global',
                'service_id'=>'0'

            ]
    ]);
    }
}
