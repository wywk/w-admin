<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'menu_name' => '权限管理',
                'sort' => 18,
                'url' => '',
                'icon' => '&#xe601;',
                'remark' => '',
                'pid' => 0,
                'is_show' => 1,
                'created_at' => '2019-09-06 08:38:05',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            1 => 
            array (
                'id' => 2,
                'menu_name' => '角色管理',
                'sort' => 1,
                'url' => '/admin/role/list',
                'icon' => '&#xe69e;',
                'remark' => '',
                'pid' => 1,
                'is_show' => 1,
                'created_at' => '2019-09-06 08:38:05',
                'updated_at' => '2020-05-28 15:55:01',
            ),
            2 => 
            array (
                'id' => 3,
                'menu_name' => '菜单管理',
                'sort' => 2,
                'url' => '/admin/menu/list',
                'icon' => '&#xe604;',
                'remark' => '',
                'pid' => 1,
                'is_show' => 1,
                'created_at' => '2019-09-06 08:38:05',
                'updated_at' => '2020-05-28 15:55:11',
            ),
            3 => 
            array (
                'id' => 4,
                'menu_name' => '账号列表',
                'sort' => 3,
                'url' => '/admin/admin/list',
                'icon' => '&#xe6da;',
                'remark' => '',
                'pid' => 1,
                'is_show' => 1,
                'created_at' => '2019-09-06 08:38:05',
                'updated_at' => '2020-05-28 15:55:36',
            ),
            4 => 
            array (
                'id' => 5,
                'menu_name' => '添加编辑角色',
                'sort' => 19,
                'url' => '/admin/role/add',
                'icon' => '',
                'remark' => '',
                'pid' => 2,
                'is_show' => 0,
                'created_at' => '2020-05-15 15:41:58',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            5 => 
            array (
                'id' => 6,
                'menu_name' => '删除角色',
                'sort' => 20,
                'url' => '/admin/role/del',
                'icon' => '',
                'remark' => '',
                'pid' => 2,
                'is_show' => 0,
                'created_at' => '2020-05-15 15:43:01',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            6 => 
            array (
                'id' => 7,
                'menu_name' => '授权',
                'sort' => 21,
                'url' => '/admin/role/setMenu',
                'icon' => '',
                'remark' => '',
                'pid' => 2,
                'is_show' => 0,
                'created_at' => '2020-05-15 15:43:30',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            7 => 
            array (
                'id' => 8,
                'menu_name' => '添加编辑菜单',
                'sort' => 22,
                'url' => '/admin/menu/edit',
                'icon' => '',
                'remark' => '',
                'pid' => 3,
                'is_show' => 0,
                'created_at' => '2020-05-15 15:44:06',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            8 => 
            array (
                'id' => 9,
                'menu_name' => '拖动排序',
                'sort' => 23,
                'url' => '/admin/menu/editSort',
                'icon' => '',
                'remark' => '',
                'pid' => 3,
                'is_show' => 0,
                'created_at' => '2020-05-15 15:44:36',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            9 => 
            array (
                'id' => 10,
                'menu_name' => '菜单删除',
                'sort' => 24,
                'url' => '/admin/menu/del',
                'icon' => '',
                'remark' => '',
                'pid' => 3,
                'is_show' => 0,
                'created_at' => '2020-05-15 15:57:55',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            10 => 
            array (
                'id' => 11,
                'menu_name' => '公共节点',
                'sort' => 25,
                'url' => '/',
                'icon' => '',
                'remark' => '',
                'pid' => 0,
                'is_show' => 0,
                'created_at' => '2020-05-15 16:02:38',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            11 => 
            array (
                'id' => 12,
                'menu_name' => '添加编辑账号',
                'sort' => 26,
                'url' => '/admin/admin/add',
                'icon' => '',
                'remark' => '',
                'pid' => 4,
                'is_show' => 0,
                'created_at' => '2020-05-15 16:03:13',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            12 => 
            array (
                'id' => 13,
                'menu_name' => '修改个人密码',
                'sort' => 27,
                'url' => '/admin/admin/password',
                'icon' => '',
                'remark' => '',
                'pid' => 11,
                'is_show' => 0,
                'created_at' => '2020-05-15 16:04:05',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            13 => 
            array (
                'id' => 14,
                'menu_name' => '账号停用启用',
                'sort' => 28,
                'url' => '/admin/admin/stop',
                'icon' => '',
                'remark' => '',
                'pid' => 4,
                'is_show' => 0,
                'created_at' => '2020-05-15 16:04:38',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            14 => 
            array (
                'id' => 15,
                'menu_name' => '帐号删除',
                'sort' => 29,
                'url' => '/admin/admin/del',
                'icon' => '',
                'remark' => '',
                'pid' => 4,
                'is_show' => 0,
                'created_at' => '2020-05-15 16:05:55',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            15 => 
            array (
                'id' => 16,
                'menu_name' => '操作日志',
                'sort' => 37,
                'url' => '/admin/log/list',
                'icon' => '&#xe795;',
                'remark' => '',
                'pid' => 1,
                'is_show' => 1,
                'created_at' => '2020-05-16 16:22:02',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            16 => 
            array (
                'id' => 17,
                'menu_name' => '工具箱',
                'sort' => 17,
                'url' => '',
                'icon' => '',
                'remark' => '',
                'pid' => 0,
                'is_show' => 1,
                'created_at' => '2020-08-11 16:31:24',
                'updated_at' => '2020-08-11 16:31:33',
            ),
            17 => 
            array (
                'id' => 18,
                'menu_name' => 'Excel上传',
                'sort' => 72,
                'url' => '/admin/test/excel',
                'icon' => '',
                'remark' => '',
                'pid' => 17,
                'is_show' => 1,
                'created_at' => '2020-08-11 16:32:20',
                'updated_at' => '2020-08-11 16:32:20',
            ),
        ));
        
        
    }
}