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

        // GET fake user record and check if 200 status is returned and the response was successful.
        // Also check to see if first name does exist in the response payload
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
        // $users = factory(User::class,100)->create();

        // // GET fake user record and check if 200 status is returned and the response was successful.
        // // Also check to see if first name does exist in the response payload
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

    public function test_store_method_with_correct_user_payload()
    {
        $response = $this->post(route('users.store'), [
            'first_name' => 'Omphemetse',
            'last_name' => 'Mafoko',
            'email' => 'omphemetsemafoko@gmail.com',
            'position' => 'PHP Developer'
        ]);

        $response->assertStatus(201)->assertJsonFragment(['message' => 'created']);
    }

    public function test_update_method_with_unique_email_user_payload()
    {
        $users = factory(User::class, 1)->create();
        $payload = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail,
            'position' => $this->faker->realText($this->faker->numberBetween(10,20))
        ];

        // NB: This conversion below can cripple your brain and cause you a brain damage if you are not ware of this convertion strategy.
        // Provided on code for evaluation ['message' => 'updated']
        // Actual code output will be [{"message":"updated"}]
        $this->json('PUT', 'api/users/'.$users[0]->id, $payload)
        ->assertJsonFragment(['message' => 'updated'])
        ->assertStatus(200);
    }

    public function test_update_method_with_already_taken_email_user_payload()
    {
        $users = factory(User::class, 1)->create();
        $payload = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $users[0]->email,
            'position' => $this->faker->realText($this->faker->numberBetween(10,20))
        ];

        // NB: This conversion below can cripple your brain and cause you a brain damage if you are not ware of this convertion strategy.
        // Provided on code for evaluation [["errors" => ["email" => ["The email has already been taken."]],"message" => "The given data was invalid."]]
        // Actual code output will be [{"errors":{"email":["The email has already been taken."]},"message":"The given data was invalid."}]
        $this->json('PUT', 'api/users/'.$users[0]->id, $payload)
        ->assertJsonFragment([["errors" => ["email" => ["The email has already been taken."]],"message" => "The given data was invalid."]])
        ->assertStatus(422);
    }

    public function test_delete_method_to_remove_user()
    {
        $users = factory(User::class, 1)->create();

        // NB: This conversion below can cripple your brain and cause you a brain damage if you are not ware of this convertion strategy.
        // Provided on code for evaluation [["errors" => ["email" => ["The email has already been taken."]],"message" => "The given data was invalid."]]
        // Actual code output will be [{"errors":{"email":["The email has already been taken."]},"message":"The given data was invalid."}]
        $this->json('DELETE', 'api/users/'.$users[0]->id)
        // ->assertJsonFragment([])
        ->assertStatus(204);
    }

    // public function test_index_method_returns_a_user() {
    //     // Create fake user
    //     $users = factory(User::class, 1)->create();

    //     // $payload = [[
    //     //         "data" => [
    //     //             "email" => $users[0]->email,
    //     //             "first_name" => $users[0]->first_name,
    //     //             "id" => $users[0]->id,
    //     //             "last_name" => $users[0]->last_name,
    //     //             "position" => $users[0]->position
    //     //         ]
    //     //     ]
    //     // ];

    //     $payload = [[
    //             "data" => [
    //                 "email" => null,
    //                 "first_name" => null,
    //                 "id" => null,
    //                 "last_name" => null,
    //                 "position" => null,
    //             ]
    //         ]
    //     ];

    //     // Actual code output will be  [{"data":{"created_at":"","email":null,"first_name":null,"id":null,"last_name":null,"position":null,"updated_at":""}}]
    //     $this->json('GET', 'api/users/'.$users[0]->id)
    //     ->assertJsonFragment($payload)
    //     ->assertStatus(200);
    // }
}
