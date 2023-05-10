<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Poll;
use App\Models\User;

class PollElementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $poll = Poll::inRandomOrder()->get()->first();
        $user = User::inRandomOrder()->get()->first();

        return [
            'title' => $this->faker->sentence(),
            'poll_id' => $poll->id,
            'user_id' => $user->id
        ];
    }
}
