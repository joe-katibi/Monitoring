<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            [

            'name'=>'Agent',
            'position_id'=>'1'

            ],
            [

            'name'=>'Supervisor',
            'position_id'=>'2'

            ],
            [

            'name'=>'Quality Analyst',
            'position_id'=>'3'

            ],
            [

            'name'=>'Trainer',
            'position_id'=>'4'

            ],
            [

            'name'=>'System Admin',
            'position_id'=>'5'

            ]
    ]);
    }
}
