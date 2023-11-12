<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [

            'status_name'=>'Active',
            'status_id'=>'1'

            ],
            [

            'status_name'=>'Inactive',
            'status_id'=>'0'

            ]

        ]);
    }
}
