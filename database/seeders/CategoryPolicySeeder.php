<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Policy;

class CategoryPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        Policy::all()->each(function($policy) use ($categories){
            $policy->categories()->attach(
                $categories->random(1)->pluck('id')
            );
        });
    }
}
