<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$param)
    {

        if(Auth::guest()){
            return redirect()->route('login');
        }
        else{

            $is_permission=\App\Models\Permission::where('role_id',auth()->user()->role_id)
                            ->whereIn('route_name',explode('|',$param))
                            ->get()
                            ->count();
            if(!$is_permission){
                abort(401);
            }
        }
        return $next($request);

    }
}
