<?php

namespace App\Http\Middleware;

use App\Models\VerificationCode;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class accountVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('web')->check())
        {
            $user = Auth::guard('web')->user();
            if ($user) {
                if ($user->email_verified_at === null) {
                    return redirect()->route('send.code', [encrypt($user->email)]);
                }
            }
        }

        return $next($request);
    }
}
