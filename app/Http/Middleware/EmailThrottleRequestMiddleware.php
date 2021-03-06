<?php

namespace App\Http\Middleware;


use Illuminate\Routing\Middleware\ThrottleRequests;

class EmailThrottleRequestMiddleware extends ThrottleRequests
{

    protected function resolveRequestSignature($request)
    {
        return $request->input('email');
    }
}
