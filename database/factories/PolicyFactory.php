<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Policy;
use Illuminate\Database\Eloquent\Factories\Factory;

class PolicyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    //  public function configure()
    //  {
    //      return $this->afterCreating(function (Policy $policy, User $user=null) {
    //          // Do something after the user has been created
    //         if ($user->isNotEmpty()){
    //             $user->policy()->associate($policy);
    //         }

    //      });
    //  }

    public function definition()
    {
        //Fill in data by a user if a random number between 1 and 75 is prime (28% of the time);
        if ($this->isPrime(rand(1,75))){
            $user = User::inRandomOrder()->get()->first();
            return [
                'title' => $this->faker->sentence(),
                'details' =>$this->faker->paragraph(),
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'user_id' => $user->id,
            ];
        }

        return [
            'title' => $this->faker->sentence(),
            'details' =>$this->faker->paragraph(),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }

    public function isPrime($number){
        if ($number % 2 == 0) {
            return false;
          }

          for ($i = 3; $i <= sqrt($number); $i += 2) {
            if ($number % $i == 0) {
              return false;
            }
          }
          return true;
    }
}
