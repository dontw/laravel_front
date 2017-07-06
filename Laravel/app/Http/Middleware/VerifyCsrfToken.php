<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Http\Request;
class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //All api function will validate token on backend service
        //'api/*',
    ];

    /**
    * Determine if the session and input CSRF tokens match.
    *
    * @param \Illuminate\Http\Request $request
    * @return bool
    */
    protected function tokensMatch($request)
    {        
        // If request is an ajax request, then check to see if token matches token provider in
        // the header. This way, we can use CSRF protection in ajax requests also.
        $token = $request->header('X-CSRF-Token');
        //echo $request->header('X-CSRF-Token') . ' , ' . $request->session()->token();
        //return $request->session()->token() == $request->header('X-CSRF-Token');
    }
}
