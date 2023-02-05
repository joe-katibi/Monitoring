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

            'name'=>'Kenya',
            'country_id'=>'1'

            ],
            [

            'name'=>'Uganda',
            'country_id'=>'2'
    
            ],
            [

            'name'=>'Tanzania',
            'country_id'=>'3'
    
            ],
            [
    
            'name'=>'Malawi',
            'country_id'=>'4'
        
            ],
            [
    
            'name'=>'Zambia',
            'country_id'=>'5'
        
            ]
    ]);
    }
}
