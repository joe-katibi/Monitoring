<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [

            'department_name'=>'Information Technology',
            'description'=>'Information Technology',
            'created_by'=>'1'


            ],
            [

            'department_name'=>'Quality Analyst',
            'description'=>'Quality Analyst',
            'created_by'=>'1'

            ],
            [

            'department_name'=>'Billing',
            'description'=>'Billing',
            'created_by'=>'1'

            ],
            [

            'department_name'=>'Service Support',
            'description'=>'Service Support',
            'created_by'=>'1'

            ],
            [

            'department_name'=>'Shops',
            'description'=>'Shops',
            'created_by'=>'1'

            ],
            [

            'department_name'=>'Digital Media',
            'description'=>'Digital Media',
            'created_by'=>'1'

            ],
            [

            'department_name'=>'Outbound',
            'description'=>'Outbound',
            'created_by'=>'1'

            ],
            [

            'department_name'=>'Inbound',
            'description'=>'Inbound',
            'created_by'=>'1'

            ]
            [

            'department_name'=>'Trainer',
            'description'=>'Trainer',
            'created_by'=>'1'

            ]
    ]);
    }
}
