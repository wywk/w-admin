<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class TestController extends Controller
{

    /**
     * EXCEL导入
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author wywk  947036348@qq.com
     * @date 2020/8/11 16:29
     */
    public function import(Request $request)
    {
        $file = $this->upload($request);
        if (!$file) {
            return $this->error();
        }
        $read = new Xlsx();
        $spreadsheet = $read->load(Storage::path($file));
        $activeSheet = $spreadsheet->getActiveSheet();
        $highestRow = $activeSheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            $value = $activeSheet->getCellByColumnAndRow(1, $row)->getValue();
        }
        return $this->success("上传成功！");
    }

}
