<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admins')->delete();
        
        \DB::table('admins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'nyg1991@aliyun.com',
                'status' => 1,
                'role_id' => 1,
                'password' => encrypt('123456'),
                'created_at' => '2020-05-09 10:44:47',
                'updated_at' => '2020-05-09 10:44:47',
                'deleted_at' => NULL,
                'remember_token' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'test',
                'email' => 'nyg1991@aliyun.com',
                'status' => 1,
                'role_id' => 1,
                'password' => encrypt('123456'),
                'created_at' => '2020-05-13 11:47:30',
                'updated_at' => '2020-05-13 11:47:30',
                'deleted_at' => NULL,
                'remember_token' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'tp001',
                'email' => '10@qq.com',
                'status' => 1,
                'role_id' => 1,
                'password' => encrypt('123456'),
                'created_at' => '2020-06-12 18:12:43',
                'updated_at' => '2020-06-12 18:12:43',
                'deleted_at' => NULL,
                'remember_token' => NULL,
            ),
        ));
        
        
    }
}