<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user()->profile){
            return redirect()->route('profile.create')
            ->with('message', 'Please complete your profile before proceeding.');
        }
        return $next($request);
    }
}
