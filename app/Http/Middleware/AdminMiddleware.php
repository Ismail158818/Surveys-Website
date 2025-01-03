<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $user = auth()->user();
        if (auth()->user()->role_id==1)
        {
            return $next($request);
        } else {
            abort(403, 'anAuth');
        }
    }
}
