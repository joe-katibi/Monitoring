<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CallRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('call_ratings')->insert([
            [

            'rating_name'=>'Best',
            'rating_id'=>'1'

            ],
            [

            'rating_name'=>'Worst',
            'rating_id'=>'2'

            ]
            ,

    ]);
    }
}
