<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketStatusSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_statuses')->insert([
            [

            'status_name'=>'Slipping',
            'status_id'=>'1'

            ],
            [

                'status_name'=>'Pending',
                'status_id'=>'2'

            ]
            ,
            [

                'status_name'=>'Completed',
                'status_id'=>'3'

            ]
    ]);
    }
}
