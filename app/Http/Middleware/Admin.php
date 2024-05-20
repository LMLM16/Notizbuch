<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

class Admin
{


    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user == null ||$user->role != "admin") {
            return response()->json(['user is not admin'], 401);
        }

        return $next($request);
    }
}
