<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class ThrottleRequests extends \Illuminate\Routing\Middleware\ThrottleRequests
{
    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1, $prefix = '')
    {
        $key = $prefix . $this->resolveRequestSignature($request);

        $maxAttempts = $this->resolveMaxAttempts($request, $maxAttempts);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            return $this->buildException($request, $key, $maxAttempts);
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        $response = $next($request);

        return $this->addHeaders($response, $maxAttempts, $this->calculateRemainingAttempts($key, $maxAttempts));
    }

    protected function buildException($request, $key, $maxAttempts, $responseCallback = null)
    {
        $retryAfter = $this->getTimeUntilNextRetry($key);

        $headers = $this->getHeaders($maxAttempts, $this->calculateRemainingAttempts($key, $maxAttempts, $retryAfter), $retryAfter);
        return response()->json([
            'code' => 429,
            'status' => 'error',
            'msg' => "您的请求太频繁，已被限制请求",
        ])->withHeaders($headers);
    }
}
