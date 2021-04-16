<?php

use Illuminate\Database\Seeder;

class RoleMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_menus')->delete();
        
        \DB::table('role_menus')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'menu_id' => 1,
            ),
            1 => 
            array (
                'role_id' => 1,
                'menu_id' => 2,
            ),
            2 => 
            array (
                'role_id' => 1,
                'menu_id' => 4,
            ),
            3 => 
            array (
                'role_id' => 1,
                'menu_id' => 7,
            ),
            4 => 
            array (
                'role_id' => 1,
                'menu_id' => 8,
            ),
            5 => 
            array (
                'role_id' => 1,
                'menu_id' => 13,
            ),
            6 => 
            array (
                'role_id' => 1,
                'menu_id' => 14,
            ),
            7 => 
            array (
                'role_id' => 1,
                'menu_id' => 18,
            ),
            8 => 
            array (
                'role_id' => 1,
                'menu_id' => 3,
            ),
            9 => 
            array (
                'role_id' => 1,
                'menu_id' => 17,
            ),
            10 => 
            array (
                'role_id' => 1,
                'menu_id' => 12,
            ),
            11 => 
            array (
                'role_id' => 1,
                'menu_id' => 15,
            ),
            12 => 
            array (
                'role_id' => 1,
                'menu_id' => 16,
            ),
            13 => 
            array (
                'role_id' => 1,
                'menu_id' => 5,
            ),
            14 => 
            array (
                'role_id' => 1,
                'menu_id' => 6,
            ),
            15 => 
            array (
                'role_id' => 1,
                'menu_id' => 9,
            ),
            16 => 
            array (
                'role_id' => 1,
                'menu_id' => 10,
            ),
            17 => 
            array (
                'role_id' => 1,
                'menu_id' => 11,
            ),
        ));
        
        
    }
}