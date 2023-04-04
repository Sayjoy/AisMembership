<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Stevebauman\Location\Facades\Location;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('logged-in', function($user){
            return $user;
        });

        Gate::define('is-admin', function($user){
            return $user->hasAnyRole('admin');
            //return $user->hasAnyRoles(['admin', 'author']);
        });

        //This gate does not seems to work when a user is not logged in.
        Gate::define('allowed-country', function($user){
            $restricted_country_codes = ['NG'];

            //$ip = $request->ip(); /* Dynamic IP address */
            $ip = '48.188.144.248'; /* '102.88.34.154' Static IP address */

            $currentUserInfo = Location::get($ip);

            return !in_array($currentUserInfo->countryCode, $restricted_country_codes);

        });

        Gate::define('is-admin-moderator', function($user){
            return $user->hasAnyRoles(['admin', 'moderator']);
        });

    }
}
