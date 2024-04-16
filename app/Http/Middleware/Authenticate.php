<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }
    protected function redirectTo(Request $request) {
        if (! $request->expectsJson()) {
            if($request->routeIs('author.*')) {
                session()->flash('fail', 'You must login first');
                return route('author.login', ['fail' => true, 'returnUrl'=> URL::current()]);
            }
        }
    }
}
