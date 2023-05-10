<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poll;
use App\Http\Controllers\PollController;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Poll::factory()->times(10)->create();

        $poll_id = Poll::inRandomOrder()->get()->first()->id;
        $poll_controller = new PollController;
        $poll_controller->openPoll($poll_id);
    }
}
