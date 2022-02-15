<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Landlord;
use App\Models\Tenant;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        if(!Auth::guard('landlord')->check() && !Auth::guard('tenant')->check()) abort(401, 'Unathorized');

        if(Auth::guard('landlord')->check()) {
            $user = Auth::guard('landlord')->user();
            Auth::setUser(Landlord::find($user->id));
        }
        
        if(Auth::guard('tenant')->check()) {
            $user = Auth::guard('tenant')->user();
            Auth::setUser(Tenant::find($user->id));
        }

        return $next($request);
    }
}
