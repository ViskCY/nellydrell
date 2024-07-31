<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class DomainLocale
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
        $host = $request->getHost();

        if (strpos($host, 'nellydrell.ee') !== false) {
            App::setLocale('et');
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}
