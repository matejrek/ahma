<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;

class Isadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::check()) {
            $userId = auth()->user()->id;
            $isadmin = Role::all()->where('user_id', $userId)->first();

            if($isadmin){
                if($isadmin['admin'] == 1){
                    return $next($request);
                }
                else{
                    return redirect('/');
                }
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/');
        }

        //return $next($request);
    }
}
