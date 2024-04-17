<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $currentUri = $request->path();

        if (!$request->expectsJson()) {
            if (Str::startsWith($currentUri, 'admin')) {
                return route('admin.login');
            }
            return route('login');
        }
        return null;
    }
}
