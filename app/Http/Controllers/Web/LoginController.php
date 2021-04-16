<?php

namespace App\Http\Controllers\Web;

use App\Model\Admin;
use App\Model\Coupon;
use App\Model\File;
use App\Model\Menu;
use App\Model\RoleMenu;
use App\Repository\CouponRepository;
use App\Service\MenuService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:03
     */
    public function login(Request $request)
    {
        $name = $request->input('adminName');
        $password = $request->input('password');
        $user = Admin::where('name', $name)->first();
        if (!$user) {
            return $this->error('账号不存在！');
        }
        if ($password != decrypt($user->password)) {
            return $this->error('账号密码错误！');
        }
        if ($user->status == 0) {
            return $this->error('帐号未启用！');
        }
        auth('web')->login($user);
        $menu_ids = RoleMenu::where(['role_id' => $user->role_id])->pluck('menu_id')->toArray();
        $urls = Menu::whereIn('id', $menu_ids)->pluck('url')->toArray();
        $menu = MenuService::getMenu(0, $menu_ids);
        session(['menu' => $menu, 'user' => $user->toArray(), 'menu_ids' => $menu_ids, 'urls' => $urls]);
        return $this->success('登录成功！');
    }

    /**
     * 退出
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author wywk  947036348@qq.com
     * @date 2019/9/6 16:03
     */
    public function logout(Request $request)
    {
        \Auth::logout();
        return redirect('login');
    }
}
