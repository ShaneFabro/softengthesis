<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIsFacultyHead
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
        if(auth()->user()->role_id == 3 && auth()->user()->is_active == 1){

            return $next($request);

        } elseif(auth()->user()->role_id == 4) {

            return redirect(route('member.index'));

        } elseif(auth()->user()->role_id == 2) {

            return redirect(route('dean.index'));

        } elseif(auth()->user()->role_id == 1) {

            return redirect(route('admin.index'));

        }
    }
}
