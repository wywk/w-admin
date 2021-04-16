<?php

namespace App\Http\Middleware;

use Closure;
use App\Service\AesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 * 外部系统调用接口
 * Class AppMiddleware
 * @package App\Http\Middleware\Api
 */
class AppMiddleware
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = $request->input();
        if (empty($data['sign'])) {
            return $this->error(400, '签名不能为空！');
        }
        $key = config('constant.app_key');
        if (!AesService::sign_decrypt($data, $data['sign'], $key)) {
            return $this->error(403, '签名验证失败！');
        }
        return $next($request);
    }

    /**
     * 返回错误信息
     * @param $code
     * @param string $msg
     * @return JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2020/6/4 9:56
     */
    private function error($code, $msg = '')
    {
        return response()->json([
            'code' => $code,
            'status' => 'error',
            'msg' => $msg,
        ]);
    }
}
