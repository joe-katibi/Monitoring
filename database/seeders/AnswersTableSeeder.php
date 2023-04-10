<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            [

            'answer_name'=>'A',
            'answer_id'=>'1'

            ],
            [

            'answer_name'=>'B',
            'answer_id'=>'2'

            ],
            [

            'answer_name'=>'C',
            'answer_id'=>'3'

            ],
            [

            'answer_name'=>'D',
            'answer_id'=>'4'

            ],
            [

            'answer_name'=>'E',
            'answer_id'=>'5'

            ]
    ]);

    }
}
