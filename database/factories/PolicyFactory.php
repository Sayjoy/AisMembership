<?php

namespace Database\Factories;

use App\Models\User;
use App\Helpers\PrimeNumbers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PolicyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        //Approve some of the policy
        $r = rand(1,30);
        if (PrimeNumbers::isPrime($r)){
            $action = True;
            $p_id = 'P-'.date('ymd');
            $comment = $this->faker->sentence();
            $approved_at = Carbon::now();
            $approver_id = User::inRandomOrder()->get()->first()->id;

            //Publish some
            if ($r<10){
                $published_at = Carbon::now();
                $publisher_id = User::inRandomOrder()->get()->first()->id;
            }
            else {
                $published_at = Null;
                $publisher_id = Null;
            }

        } else {
            $action = False;
            $p_id = Null;
            $comment = "";
            $approved_at = Null;
            $approver_id = Null;
            $published_at = Null;
            $publisher_id = Null;
        }

        //Fill in data by a user if a random number between 1 and 75 is prime (28% of the time);
        if (PrimeNumbers::isPrime(rand(1,75))){
            $user = User::inRandomOrder()->get()->first();
            $name = $user->name;
            $email = $user->email;
            $phone = $user->phone;
            $user_id = $user->id;
        } else {
            $name = $this->faker->name();
            $email = $this->faker->safeEmail();
            $phone = $this->faker->phoneNumber();
            $user_id = Null;
        }

        return [
            'title' => $this->faker->sentence(),
            'details' =>$this->faker->paragraph(),
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'user_id' => $user_id,
            'approval' => $action,
            'comment' => $comment,
            'approved_at' => $approved_at,
            'approver_id' => $approver_id,
            'policy_id' => $p_id,
            'published_at' => $published_at,
            'publisher_id' => $publisher_id,
        ];
    }
}
