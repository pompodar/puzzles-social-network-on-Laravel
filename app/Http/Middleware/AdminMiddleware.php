<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (auth()->check() && auth()->user()->admin) {
            return $next($request);
        }

        // Redirect or perform another action for non-admin users
        return redirect('/'); // Change the URL or action as needed
    }
}
