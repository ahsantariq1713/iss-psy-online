<?php

namespace App\Http\Middleware;

use App\Helpers\VerificationCodes;
use App\Models\VerificationCode;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $user = Auth::user();
        if (is_null($user->email_verified_at)) {
            $url = $user->emailVerificationLink();
            return redirect($url);
        }
        return $next($request);
    }
}
