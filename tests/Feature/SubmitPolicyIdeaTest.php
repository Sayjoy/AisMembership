<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Policy;
use App\Models\Category;
use App\Models\User;

class SubmitPolicyIdeaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_guest_can_submit_policy_idea()
    {
        $policy_data = Policy::factory()->make()->first();
        $categories =  Category::all()->random(rand(1,3))->pluck('id');

        $response = $this->post('/policy-store',[
            'title'=> $policy_data->title,
            'details' => $policy_data->details,
            'name' => $policy_data->name,
            'phone' => $policy_data->phone,
            'email' => $policy_data->email,
            'categories'=>$categories,
        ]);

        $response->assertRedirect('/policy-ideas');
    }

    public function test_member_can_submit_policy_idea()
    {
        $policy_data = Policy::factory()->make()->first();
        $categories =  Category::all()->random(rand(1,3))->pluck('id');
        $user = User::inRandomOrder()->get()->first();
        auth()->login($user);

        $response = $this->post('/policy-store',[
            'title'=> $policy_data->title,
            'details' => $policy_data->details,
            'name' => $policy_data->name,
            'phone' => $policy_data->phone,
            'email' => $policy_data->email,
            'categories'=>$categories,
        ]);

        $response->assertRedirect('/policy-ideas');
    }
}
