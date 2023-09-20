<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocalizationAdmin
{
    protected const ALLOWED_LOCALIZATIONS = ['en', 'ar', 'ku','tr'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->roles->first()->name == 'restaurant'){
        $localization = $request->header('Accept-Language');
        $localization = in_array($localization, self::ALLOWED_LOCALIZATIONS, true) ? $localization : 'en';
        app()->setLocale($localization);
        }
        return $next($request);
    }
}
