<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PollElement;
use App\Models\User;
use App\Models\Poll;

class PollElementUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i<50; $i++){
            $item = PollElement::inRandomOrder()->get()->first();
            $user = User::inRandomOrder()->get()->first();
            if(!$user->respondedToPoll($item->poll->id)){
                $item->responder()->attach($user->id);
            }

        }

    }
}
