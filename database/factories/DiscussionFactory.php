<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Policy;
use App\Helpers\PrimeNumbers;
use App\Models\Discussion;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->get()->first();
        $policy = Policy::where('approval', true)->inRandomOrder()->get()->first();
        $discuss = Discussion::inRandomOrder()->get()->first();
        $parent_id = Null;

        if ($discuss and PrimeNumbers::isPrime(rand(1,10))){
            $parent_id = $discuss->id;
        }

        return [
            'policy_id' => $policy->id,
            'user_id' => $user->id,
            'parent_id' => $parent_id,
            'reply' => $this->faker->paragraph()
        ];
    }
}
