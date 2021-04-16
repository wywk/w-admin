<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\File;
use App\Repository\AipRepository;
use Illuminate\Http\Request;

class FileController extends Controller
{

    /**
     * 图片列表
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @author wywk  947036348@qq.com
     * @date 2020/5/11 11:37
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $where = $request->only('origin_name', 'identify_progress', 'type', 'created_at');
            $list = File::query()->search($where)->orderBy('id', 'desc')->paginate($request->input('limit', 10));
            $sumsize = File::query()->search($where)->sum('size');
            return $this->tableAjax($list, ['sum_size' => getFilesize($sumsize)]);
        } else {
            $identify_progress = File::IdentifyProgress;
            $type = File::Type;
            return view('admin.file.list', ['identify_progress' => $identify_progress, 'type' => $type]);
        }
    }

    /**
     * 重新识别
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2020/5/11 18:25
     */
    public function re_identify(Request $request)
    {
        $id = $request->input('id');
        return $this->success('识别成功！');
    }

    /**
     * 删除图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2020/5/11 18:29
     */
    public function delete_img(Request $request)
    {
        $id = $request->input('id');
        if (File::destroy($id)) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

}
