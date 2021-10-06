<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        /*
            //* ### This for Unauthenticated users that trying access auth routes ###

            - //& *!$request->expectsJson()* => checking if the request not excepting Json which means that if the request not ajax request or api request then shall be redirected to defined routes as below
        */
        if (!$request->expectsJson()) {

            if ($request->routeIs('admin.*')) {

                return route('admin.login');
            }

            return route('login');
        }
    }
}
