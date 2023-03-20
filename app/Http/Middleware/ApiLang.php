<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ApiLang
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
        $lang = defaultLang();
        if ($request->header('Lang') != null && in_array($request->header('Lang'), languages())) {
          $lang = $request->header('Lang');
        } elseif (auth()->check()) {
          $lang = auth()->user()->lang;
        }
    
        App::setLocale($lang);
        Carbon::setLocale($lang);
        return $next($request);
    }
}