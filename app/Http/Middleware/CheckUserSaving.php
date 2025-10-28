<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserSaving
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->routeIs('saving.create')){
            if(!$request->user_id){
                return redirect()->route('saving.check-user')->with('info','Please select a user to proceed with the transaction.');
            }
        }
        return $next($request);
    }
}
