<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_name' => '超级管理员',
                'remark' => '超级管理员',
                'created_at' => '2019-09-26 09:39:18',
                'updated_at' => '2019-09-26 09:39:18',
            ),
            1 => 
            array (
                'id' => 2,
                'role_name' => '财务',
                'remark' => '财务人员',
                'created_at' => '2020-05-13 11:46:46',
                'updated_at' => '2020-05-13 11:46:46',
            ),
        ));
        
        
    }
}