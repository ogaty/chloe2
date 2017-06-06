<?php

namespace Easel\Http\Middleware;

use Closure;
use Easel\Helpers\SetupHelper;

class EnsureInstalled
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
        if (! SetupHelper::isInstalled()) {
            return redirect()->route('canvas.install');
        }

        return $next($request);
    }
}