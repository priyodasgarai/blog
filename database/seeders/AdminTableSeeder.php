<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Admin::deleted();       
        $adminRecords = [
            ['name'=>'admin', 'type'=>'admin', 'mobile'=>'7031552020', 'email'=>'admin@admin.com', 
                 'password'=>'$2y$10$yo56P0Cfiba13.J2DxfqOuWLE9o46GH0.prpPkaXfPvzEPGC1k6uC', 'image'=>'', 'status'=>1,],
             ['name'=>'mrinal', 'type'=>'admin', 'mobile'=>'7031552020', 'email'=>'mrinal@admin.com', 
                 'password'=>'$2y$10$yo56P0Cfiba13.J2DxfqOuWLE9o46GH0.prpPkaXfPvzEPGC1k6uC', 'image'=>'', 'status'=>1,],
             ['name'=>'ashis', 'type'=>'subadmin', 'mobile'=>'7031552020', 'email'=>'thiru301197@gmail.com', 
                 'password'=>'$2y$10$yo56P0Cfiba13.J2DxfqOuWLE9o46GH0.prpPkaXfPvzEPGC1k6uC', 'image'=>'', 'status'=>1,],
             ['name'=>'habul', 'type'=>'admin', 'mobile'=>'7031552020', 'email'=>'habul@admin.com', 
                 'password'=>'$2y$10$yo56P0Cfiba13.J2DxfqOuWLE9o46GH0.prpPkaXfPvzEPGC1k6uC', 'image'=>'', 'status'=>1,],
        ];
        Admin::insert($adminRecords);
    }
}
