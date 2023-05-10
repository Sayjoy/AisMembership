<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PollElement;

class PollElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PollElement::factory()->times(30)->create();
    }
}
