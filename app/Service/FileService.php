<?php

namespace App\Service;

use App\Model\File;
use Illuminate\Http\Request;

class FileService
{
    /**
     * 文件上传
     * @param Request $request
     * @param string $key 文件键值
     * @return File|bool
     * @author wywk  947036348@qq.com
     * @date 2020/5/30 11:51
     */
    public function upload(Request $request, $key = 'file')
    {
        if (!$request->hasFile($key)) {
            return false;
        }
        $file = $request->file($key);
        $destinationPath = '/uploads/' . date('Y-m-d'); //uploads/xxxx-xx-xx 建文件夹
        $path = $file->store($destinationPath);
        $data['origin_name'] = $file->getClientOriginalName();
        $data['path'] = $path;
        $data['ext'] = $file->extension();
        $data['size'] = $file->getSize();
        $data['admin_id'] = auth()->id();;
        $model = new File();
        $model->fill($data);
        $model->save();
        return $model;
    }
}
