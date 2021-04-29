<?php

namespace App\Http\Middleware\Custom;

use Closure;
use App\Helpers\PermissionHelper;

class ClientAdminMiddleware
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
        if(! auth()->check() || false == PermissionHelper::isClientAdmin($request->user()) ) {
            return redirect('/');
        }

        return $next($request);
    }
}
