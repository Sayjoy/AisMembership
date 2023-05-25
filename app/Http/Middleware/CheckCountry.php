<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Gate;
use Stevebauman\Location\Facades\Location;

class CheckCountry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /*
         * The gate does not seems to work when no user is logged in.
         * Hence we use another implementation of the middleware
        if (Gate::allows('allowed-country')){
            return $next($request);
        }
        */

        $restricted_country_codes = config('app.restricted_country_codes');

        $ip = $request->ip(); /* Dynamic IP address- uncomment in production site */
        //$ip = '48.188.144.248'; /* 'US' Static IP address comment out in production site */
        //$ip = '102.89.34.58'; /* 'Nigerian' Static IP address comment out in production site */

        $currentUserInfo = Location::get($ip);

        if (!in_array($currentUserInfo->countryCode, $restricted_country_codes)){
            return $next($request);
        }

        $request->session()->flash('error', 'Your country is not allowed to register. Kindly contact the admin');
        return redirect('/');

    }
}
