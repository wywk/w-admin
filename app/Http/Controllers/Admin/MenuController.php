<?php

namespace App\Http\Controllers\Admin;

use App\Model\Menu;
use App\Model\RoleMenu;
use App\Service\MenuService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function list(Request $request){
        $model=Menu::with('children.children')->where('pid',0)->orderBy('sort','asc')->get();
        $list=MenuService::getMenuArr($model);
        return view('admin.menu.list',['list'=>$list]);
    }

    /**
     * 添加菜单
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:10
     */
    public function edit(Request $request){
        $data=$request->only('menu_name','url','icon','pid','remark');
        $data=array_filter($data,function ($v){return !is_null($v);});
        $data['is_show']=$request->has('is_show');
        $menu=Menu::firstOrNew(['id'=>$request->input('id')]);
        $menu->fill($data);
        if($menu->save()){
            if($menu->sort==0){
                $menu->sort=$menu->id;
                $menu->save();
            }
            return $this->success('操作成功！',[],'/admin/menu/list');
        }else{
            return $this->error();
        }
    }

    /**
     * 获取菜单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author wywk  947036348@qq.com
     * @date 2019/9/30 11:27
     */
    public function get(Request $request){
        $id=$request->input('id');
        $info=Menu::firstOrNew(['id'=>$id]);
        $pid=$request->input('pid');
        if($pid){
            $info->pid=$pid;
            $pname=Menu::where('id',$pid)->value('menu_name');
        }else{
            $pname=Menu::where('id',$info->pid)->value('menu_name');
        }
        if(!$info->pid){
            $info->pid=0;
            $pname='顶级菜单';
        }
        return view('admin.menu.add',['info'=>$info,'pname'=>$pname]);
    }

    /**
     * 编辑变更菜单
     * @param Request $request
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:10
     */
    public function editSort(Request $request){
        $menu=Menu::find($request->input('id'));
        $targetMenu=Menu::find($request->input('target_id'));
        $type=$request->input('type');
        if($type=='prev'){//前移
            Menu::where('sort','>=',$targetMenu->sort)
                     ->where('sort','<',$menu->sort)->increment('sort');
            Menu::where('sort','<',$targetMenu->sort)
                     ->where('sort','>',$menu->sort)->decrement('sort');
            $menu->sort=$targetMenu->sort;
            $menu->pid=$targetMenu->pid;
            $menu->save();
        }elseif ($type=='next'){
            Menu::where('sort','>',$targetMenu->sort)
                     ->where('sort','<',$menu->sort)->increment('sort');
            Menu::where('sort','<=',$targetMenu->sort)
                     ->where('sort','>',$menu->sort)->decrement('sort');
            $menu->sort=$targetMenu->sort+1;
            $menu->pid=$targetMenu->pid;
            $menu->save();
        }else{
            $menu->pid=$targetMenu->id;
            $menu->save();
        }
    }

    /**
     * 删除菜单
     * @param Request $request
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:10
     */
    public function del(Request $request){
        $id=$request->input('id');
        Menu::destroy($id);
        RoleMenu::where(['menu_id'=>$id])->delete();
    }
}
