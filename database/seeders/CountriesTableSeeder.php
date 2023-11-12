<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            [

            'country_name'=>'Kenya',
            'country_id'=>'1'

            ],
            [

            'country_name'=>'Uganda',
            'country_id'=>'2'

            ],
            [

            'country_name'=>'Tanzania',
            'country_id'=>'3'

            ],
            [

            'country_name'=>'Malawi',
            'country_id'=>'4'

            ],
            [

            'country_name'=>'Zambia',
            'country_id'=>'5'

            ]
    ]);
    }
}
