<?php

namespace App\Service;

use App\Model\Menu;

class MenuService
{
    static public function getAdminMenu($pid = 0)
    {
        $list = Menu::where(['pid' => $pid])->orderBy('sort', 'asc')->where('is_show', 1)->get()->toArray();
        $data = [];
        foreach ($list as $v) {
            $children = self::getAdminMenu($v['id']);
            $tmp = $v;
            if ($children) {
                $tmp['children'] = $children;
            }
            $data[] = $tmp;
        }
        return $data;
    }
    /**
     * 获取菜单列表（菜单用）
     * @param int $pid
     * @param array $menus
     * @return array
     * @author wywk  947036348@qq.com
     * @date 2019-07-17 23:11
     */
    static public function getMenu($pid = 0, $menus = [])
    {
        $list = Menu::where(['pid' => $pid])->orderBy('sort', 'asc')->where('is_show', 1)->get()->toArray();
        $data = [];
        foreach ($list as $v) {
            if (in_array($v['id'], $menus)) {
                $tmp = $v;
                $children = self::getMenu($v['id'], $menus);
                if ($children) {
                    $tmp['children'] = $children;
                }
                $data[] = $tmp;
            }
        }
        return $data;
    }

    /**
     * 获取菜单列表-树状图
     * @param $menus
     * @param array $checked
     * @return array
     * @author wywk  947036348@qq.com
     * @date 2020/5/30 14:18
     */
    static function getMenuArr($menus, $checked = [])
    {
        $data = [];
        foreach ($menus as $v) {
            unset($tmp);
            $tmp['id'] = $v->id;
            $tmp['name'] = $v->menu_name;
            $tmp['checked'] = in_array($v->id, $checked);
            $tmp['_url'] = $v->url;
            $tmp['_icon'] = $v->icon;
            $tmp['_pid'] = $v->pid;
            $tmp['remark'] = $v->remark;
            $tmp['_show'] = $v->is_show;
            if (count($v->children) > 0) {
                $tmp['children'] = self::getMenuArr($v->children, $checked);
            }
            $data[] = $tmp;
        }
        return $data;
    }
}
