<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;

class ApplyRedirectionMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if ($redirect = Redirect::where('from', $request->path())->first()) {
            return redirect(trim($redirect->to, '/'), $redirect->code);
        }

        return $next($request);
    }
}
