<?php

namespace App\Http\Middleware;

use Closure;

class CheckSignupSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(strtolower(setting('allow_signups')) != 'yes')
        {
            return response()->json(['message' => 'Registration is disabled by website admins.'], 403);
        }
        return $next($request);
    }
}
