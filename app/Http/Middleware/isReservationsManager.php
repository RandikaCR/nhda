<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isReservationsManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private $allowedUserRoles = [3];

    public function handle(Request $request, Closure $next): Response
    {
        if ( !empty(Auth::check()) && in_array(Auth::user()->user_role_id, $this->allowedUserRoles) ) {
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
