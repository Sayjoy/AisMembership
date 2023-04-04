<?php

namespace App\Actions\Fortify;

use App\Events\NewUserCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Stevebauman\Location\Facades\Location;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        if ($input['ip']!=""){
            //$ip = $input['ip'];; /* Dynamic IP address- uncomment in production site */
            $ip = '48.188.144.248'; /* 'US' Static IP address comment out in production site */
            //$ip = '102.88.34.154'; /* 'Nigerian' Static IP address comment out in production site */

            $currentUserInfo = Location::get($ip);
            $country = $currentUserInfo->countryName;
        }
        else {
            $country = $input["country"];
        }

        if (empty($input['roles'])){
            $input['roles'][]=3;
        }

        $user = User::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'ip' => $input['ip'],
            'country' => $country,
            'password' => Hash::make($input['password']),
        ]);

        event(new NewUserCreated($user, $input['roles']));

        return $user;
    }
}
