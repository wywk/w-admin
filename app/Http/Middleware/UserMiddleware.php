<?php

namespace App\Http\Middleware;

use App\Model\Log;
use App\Model\Menu;
use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth('web')->check()) {
            if (!$request->ajax()) {
                return redirect('/login');
            } else {
                return response()->json([
                    'code' => 4000,
                    'status' => 'error',
                    'msg' => '认证失败',
                ]);
            }
        }
        $url = $request->path();
        if ($url == '/') {
            return $next($request);
        }
        $menu = Menu::where('url', '/' . $url)->first();
        if (!$menu) {
            if (!$request->ajax()) {
                return redirect('/login');
            } else {
                return response()->json([
                    'code' => 4000,
                    'status' => 'error',
                    'msg' => '认证失败',
                ]);
            }
        }
        if (!in_array($menu->id, session('menu_ids'))) {
            if (!$request->ajax()) {
                return redirect('/login');
            } else {
                return response()->json([
                    'code' => 4000,
                    'status' => 'error',
                    'msg' => '认证失败',
                ]);
            }
        }
        $data['admin_id'] = auth()->id();
        $data['url'] = $url;
        $data['name'] = $menu->menu_name;
        $data['request'] = $request->except('image_base64');
        $data['method'] = $request->method();
        $data['ip'] = $request->ip();
        $log = new Log();
        $log->fill($data);
        $log->save();
        return $next($request);
    }
}
