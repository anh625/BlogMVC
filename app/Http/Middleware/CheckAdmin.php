<?php

namespace App\Http\Middleware;

use App\Session\UserSession;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class CheckAdmin
{
    public function __construct(private UserSession $userSession)
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->userSession->isAdmin()) {
            return redirect()->route('sign-in')->withErrors(['error' => 'You need to log in with Admin privileges to continue!']);
        }
        return $next($request);
    }
}
