<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Masterproduct;

class MasterproductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Masterproduct::delete();
         $productRecords =[
            ['id'=>1,'category_id'=>2, 'section_id'=>1, 'product_name'=>'Blue T-shirt', 'product_code'=>'BT001', 'product_price'=>1500, 
            'product_discount'=>10, 'product_weight'=>200, 'product_video'=>'', 'main_image'=>'', 
            'description'=>'10', 
//                'wash_care'=>'', 'fabric'=>'', 'pattern'=>'', 'sleeve'=>'', 'fit'=>'','occassion'=>'', 
                'meta_title'=>'', 'meta_description'=>'', 'meta_keywords'=>'', 'is_featured'=>'NO', 
            'status'=>1],
            ['id'=>2,'category_id'=>2, 'section_id'=>1, 'product_name'=>'Red T-shirt', 'product_code'=>'RT001', 'product_price'=>1500, 
            'product_discount'=>15, 'product_weight'=>100, 'product_video'=>'', 'main_image'=>'', 
            'description'=>'10', 
//            'wash_care'=>'', 'fabric'=>'', 'pattern'=>'', 'sleeve'=>'', 'fit'=>'','occassion'=>'', 
                'meta_title'=>'', 'meta_description'=>'', 'meta_keywords'=>'', 'is_featured'=>'NO', 
            'status'=>1],

        ];
         Masterproduct::insert($productRecords);
    }
}
