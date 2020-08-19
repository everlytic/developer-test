<?php

namespace Tests\Feature\app\Http\Controllers\Api;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    // use DatabaseTransactions;
    // use DatabaseMigrations;
    use WithoutMiddleware;

    public function test_index_method_returns_all_users() {
        // Create fake user
        $users = factory(User::class, 1)->create();

        // GET fake user record
        $response = $this->get(route('users.index'))->assertStatus(200)->assertSuccessful()->assertSee($users[0]->first_name);

        // Loop through created fake users
        foreach($users as $user) {
            // Check to see if fake user record exit from the response of a GET call
            $response->assertJsonFragment([
                "id" => $user->id,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "email" => $user->email,
                "position" => $user->position,
            ]);
        }

        // // Create real user using faker to generate user details
        // $users = factory(User::class,101)->create();

        // // GET fake user record
        // $response = $this->get(route('users.index'))->assertStatus(200)->assertSuccessful()->assertSee($users->first_name);

        // // Loop through created fake users
        // foreach($users as $user) {
        //     // Check to see if fake user record exit from the response of a GET call
        //     $response->assertJsonFragment([
        //         "id" => $user->id,
        //         "first_name" => $user->first_name,
        //         "last_name" => $user->last_name,
        //         "email" => $user->email,
        //         "position" => $user->position,
        //     ]);
        // }
    }
}
