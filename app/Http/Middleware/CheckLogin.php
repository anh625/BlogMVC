<?php

namespace App\Http\Middleware;

use App\Session\UserSession;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class CheckLogin
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
        $excludedPaths = ['/sign-in', '/sign-up', '/logout', 'post-sign-in', '/post-sign-up'];

        if (in_array($request->path(), $excludedPaths)) {
            return $next($request);
        }

        if (!$this->userSession->getUser()) {
            return redirect('/log-in')->withErrors(['error' => 'Vui lòng đăng nhập để tiếp tục!']);
        }

        return $next($request);
    }
}
