<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    /**
     * 报告异常
     * @return void
     */
    public function report()
    {
        return;
    }

    /**
     * 转换异常为 HTTP 响应
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json(['code' => $this->getCode(), 'msg' => $this->getMessage(), 'status' => 'error']);
    }
}
