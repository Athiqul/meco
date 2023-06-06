<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //check type of user
                $user=Auth::user()->roles;
                $dash="";
                switch($user)
                {
                    case 'admin':
                       $dash="admin.dashboard";
                       break;
                    case 'vendor':
                        $dash="vendor.dashboard";
                        break;
                    case 'user':
                        $dash='user.dashboard';
                        break;
                    default:
                        $dash='customer.home';

                }
                return redirect()->route($dash);
            }
        }

        return $next($request);
    }
}
