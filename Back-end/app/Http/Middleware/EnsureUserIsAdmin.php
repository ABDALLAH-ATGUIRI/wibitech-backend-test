<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== UserRole::ADMIN) {
            return response()->json(
                [
                    'message' => 'You do not have permission to perform this action.',
                    'code' => Response::HTTP_FORBIDDEN
                ],
                Response::HTTP_FORBIDDEN
            );
        }
        return $next($request);
    }
}
