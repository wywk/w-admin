<?php

namespace App\Http\Controllers;

use App\Model\File;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($msg = '成功！', $data = [], $url = -1, $code = 0, $status = 'success')
    {
        return response()->json([
            'code' => $code,
            'status' => $status,
            'msg' => $msg,
            'data' => $this->delNull($data),
            'url' => $url,
        ]);
    }

    /**
     * 动态table返回ajax数据
     * @param $list
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2020/5/11 10:15
     */
    public function tableAjax($list, $data = [])
    {
        $data = array_merge([
            'code' => 0,
            'msg' => '成功',
            'data' => $list->items(),
            'count' => $list->total(),
        ], $data);
        return response()->json($data);
    }

    private function delNull($arr)
    {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $arr[$key] = $this->delNull($value);
            } else {
                $arr[$key] = $value ?? '';
            }
        }

        return $arr;
    }

    public function error($msg = '失败！', $code = 400, $status = 'error')
    {
        return response()->json(['code' => $code, 'status' => $status, 'msg' => $msg]);
    }

    /**
     * 单文件上传
     * @param Request $request
     * @param string $key
     * @return false|string
     * @author wywk  947036348@qq.com
     * @date 2020/8/11 16:26
     */
    public function upload(Request $request,$key='file'){
        if(!$request->hasFile($key)){
            return false;
        }
        $destinationPath = '/uploads/'.date('Y-m-d'); //uploads/xxxx-xx-xx 建文件夹
        $path = $request->file($key)->store($destinationPath);
        return $path;
    }
}
