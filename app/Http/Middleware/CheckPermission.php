<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return \Illuminate\Http\Response|mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();
        
        // Check if user has the required permission
        if ($user && $user->role && $user->role->permissions->pluck('route_name')->contains($permission)) {
            return $next($request);
        }

        // Redirect or return error if user does not have permission
        return response()->view('errors.403', [], 403);
    }
}
