<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

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
        if (! $request->expectsJson()) {

            if(FacadesRequest::is(app()->getLocale()."/student/dashborad")){

                return route("selection");

            }else if(FacadesRequest::is(app()->getLocale()."/techer/dashborad")){

                return route("selection");

            }else if(FacadesRequest::is(app()->getLocale()."/parent/dashborad")){

                return route("selection");

            }else if(FacadesRequest::is(app()->getLocale()."/admin/dashborad")){

                return route("selection");

            }

        }
    }
}
