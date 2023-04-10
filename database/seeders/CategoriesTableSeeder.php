<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('categories')->insert([
                [
    
                'category_name'=>'Cable Billing',
                'service_id'=>'1'
    
                ],
                [
    
                'category_name'=>'Cable Churn',
                'service_id'=>'1'
        
                ],
                [
    
                 'category_name'=>'Cable Digital',
                 'service_id'=>'1'
        
                ],
                [
                'category_name'=>'Cable Inbound',
                'service_id'=>'1'
            
                ],
                [
        
                'category_name'=>'Cable Outbound',
                'service_id'=>'1'
            
                ],
                [
    
                'category_name'=>'Cable Shops',
                'service_id'=>'1'
        
                ],
                [
        
                'category_name'=>'Cable Service Support',
                'service_id'=>'1'
            
                ],
                [
        
                'category_name'=>'Cable Live Calls',
                'service_id'=>'1'
            
                ],
                [
                'category_name'=>'Cable Escalation Matrix',
                'service_id'=>'1'
                
                ],
                [
            
                'category_name'=>'Cable Welcome calls',
                'service_id'=>'1'
                
                ],
                [
    
                'category_name'=>'DTH Billing',
                'service_id'=>'2'
        
                ],
                [
        
                'category_name'=>'DTH Churn',
                'service_id'=>'2'
            
                ],
                [
        
                'category_name'=>'DTH Digital',
                'service_id'=>'2'
            
                ],
                [
                'category_name'=>'DTH Inbound',
                'service_id'=>'2'
                
                ],
                [
            
                'category_name'=>'DTH Outbound',
                'service_id'=>'2'
                
                ],
                [
        
                'category_name'=>'DTH Shops',
                'service_id'=>'2'
            
                ],
                [
            
                'category_name'=>'DTH Service Support',
                'service_id'=>'2'
                
                ],
                [
            
                'category_name'=>'DTH Live Calls',
                'service_id'=>'2'
                
                ],
                [
                'category_name'=>'DTH Escalation Matrix',
                'service_id'=>'2'
                    
                ],
                [
                
                'category_name'=>'DTH Welcome calls',
                'service_id'=>'2'
                    
                ]
        ]);
        
    }
}
