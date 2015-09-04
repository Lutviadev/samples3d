<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;

class TopUsers
{
    /**
     * The redirect route
     *
     * @var Redirect
     */
    protected $goto;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        if ($request->ajax()) 
        {
            $goto = response('Unauthorized.', 401);
        } 
        else 
        {
            $goto = redirect()->guest('/dashboard');
        }

        if(Auth::user()->level() < 999)
        {
            return $goto;            
        } 

        return $next($request);
    }
}
