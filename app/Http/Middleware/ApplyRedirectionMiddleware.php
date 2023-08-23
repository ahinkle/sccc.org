<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Redirect;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
