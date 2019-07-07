<?php

namespace App\Http\Middleware;

use Closure;
use App\Setting;

class defaultLangMiddleware
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
        $lang = Setting::where(['param' => 'Defaul languaje', 'type' => 'text'])->first()->value;
        if (!empty($lang)) {
            session(['lang' => $lang]);
            
        }
        return $next($request);
    }
}
