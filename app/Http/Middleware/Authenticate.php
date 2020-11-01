<?php

namespace App\Http\Middleware;

use App\Staff;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Closure;
class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */


    public function handle($request, Closure $next)
    {

        if ($request->session()->get('id')==null) {
            return redirect()->route('login');
        }
        $s= Staff::find($request->session()->get('id'));

        if ($s->role->id==1)
        {
            Cache::put("role",1);
        }elseif ( ($s->role->id==2))
        {

           Cache::put("role",2);

        }elseif ( ($s->role->id==3))
        {
            Cache::put("role",3);
            session(['role'=>'3']);
        }
        return $next($request);
    }

}
