<?php

namespace App\Http\Middleware;

use App\Sandbox\Flash;
use Closure;
use Illuminate\Support\Facades\Auth;

class GroupPermissions
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
        if ( !$request->ajax() && array_get($request->route()->getAction(), 'as') != null )
        {   
            $user = Auth::user();

            $action = $request->route()->getAction()['as'];
            
            $action = parseAction($action); //Sandbox::helper
      
            switch ($action['action']) 
            {
                case 'index':                    
                    if ($user->level() >= 999 || $user->can($action['total']) || $user->can($action['slug']) || $user->can($action['create']) || $user->can($action['delete']) || $user->can($action['update']))
                    {                         
                        return $next($request);        
                    }
                    else
                    {
                        Flash::danger();
                        return redirect(route('dashboard'));            
                    }
                    break;
                
                default:                    
                    if ($user->level() >= 999 || $user->can($action['slug']) || $user->can($action['total']))
                    {                         
                        return $next($request);        
                    }
                    else
                    {
                        Flash::danger();
                        return redirect(route('dashboard'));            
                    }
                    break;
            }            
        }
        else
        {
            return $next($request); 
        }
    }
}
