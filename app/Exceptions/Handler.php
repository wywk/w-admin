<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     * @var array
     */
    protected $dontReport = [//
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     * @param Throwable $exception
     * @return void
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            $msg = head($exception->errors())[0];
            return response()->json(['code' => 422, 'msg' => $msg, 'status' => 'error']);
        }

        if (!($exception instanceof ApiException) && $request->Ajax()) {
            return response()->json(['code' => 500, 'msg' => $exception->getMessage(), 'status' => 'error']);
        }
        return parent::render($request, $exception);
    }
}
