<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueGeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('issue_generals')->insert([
            [

            'name'=>'Agent',
            'issue_general_id'=>'1'

            ],
            [

            'name'=>'technology',
            'issue_general_id'=>'2'

            ],
            [

            'name'=>'Process',
            'issue_general_id'=>'3'

            ],

    ]);


    }
}
