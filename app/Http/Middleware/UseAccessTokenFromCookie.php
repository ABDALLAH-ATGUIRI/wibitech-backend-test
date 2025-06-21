<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class UseAccessTokenFromCookie
{
    public function handle($request, Closure $next)
    {
        $token = $request->cookie('access_token');

        if ($token) {
            $request->headers->set('Authorization', "Bearer $token");
        } else {
            Log::info('No Token Found');
        }

        return $next($request);
    }
}
