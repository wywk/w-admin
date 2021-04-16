<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use App\Model\Menu;
use App\Model\RoleMenu;
use App\Model\Role;
use App\Service\MenuService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    /**
     * 添加角色
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:08
     */
    public function add(Request $request){
        $id=$request->input('id');
        $model=Role::firstOrNew(['id'=>$id]);
        $model->role_name=$request->input('role_name');
        $model->remark=$request->input('remark');
        if($model->save()){
            return $this->success('操作成功！',[],"/admin/role/list");
        }else{
            return $this->error('操作失败！');
        }
    }

    /**
     * 获取角色或新增
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:08
     */
    public function get(Request $request){
        $role=Role::firstOrNew(['id'=>$request->input('id')]);
        return view('admin.role.add',['role'=>$role]);
    }

    /**
     * 角色列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:08
     */
    public function list(Request $request){
        $list=Role::get();
        return view('admin.role.list',['list'=>$list]);
    }

    /**
     * 删除角色
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:09
     */
    public function del(Request $request){
        $id=$request->input('id');
        if($admin=Admin::where('role_id',$id)->first()){
            return $this->error("请先删除此角色下帐号[{$admin->name}],再删除角色！");
        }
        if(Role::destroy($id)){
            return $this->success();
        }else{
            return $this->error();
        }
    }

    /**
     * 设置菜单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:09
     */
    public function setMenu(Request $request){
        $id=$request->input('id');
        $checked=RoleMenu::where(['role_id'=>$id])->pluck('menu_id')->toArray();
        $model=Menu::with('children.children')->where('pid',0)->orderBy('sort','asc')->get();
        $list=MenuService::getMenuArr($model,$checked);
        return view('admin.role.setMenu',['list'=>$list,'id'=>$id]);
    }

    /**
     * 设置菜单Do
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:09
     */
    public function setMenuDo(Request $request){
        $check_ids = explode(',', $request->get('check_ids'));
        $nocheck_ids = explode(',', $request->get('nocheck_ids'));
        $role_id = $request->get('id');
        if($check=array_filter($check_ids)){
            foreach ($check as $id){
                RoleMenu::insert(['role_id'=>$role_id,'menu_id'=>$id]);
            }
        }
        if($nocheck=array_filter($nocheck_ids)){
            RoleMenu::where(['role_id'=>$role_id])->whereIn('menu_id',$nocheck)->delete();
        }
        return $this->success('成功！',[],"/admin/role/list");
    }
}
