<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $where = $request->all();
            $list = Log::query()->search($where)->whereHas('admin', function ($query) use ($where) {
                if (isset($where['admin_name'])) {
                    $query->where('name', 'like', "%{$where['admin_name']}%");
                }
            })->with('admin:id,name')->orderBy('id', 'desc')->paginate($request->input('limit', 10));
            return $this->tableAjax($list);
        } else {
            return view('admin.log.list');
        }
    }
}
