<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $excepts = ['sign-in', 'sign-up', 'logout','post-sign-in','post-sign-up'];

        foreach ($excepts as $except) {
            if ($request->is($except)) {
                return $next($request);
            }
        }

        if (!session()->has('user')) {
            return redirect('/sign-in');
        }

        return $next($request);
    }
}
