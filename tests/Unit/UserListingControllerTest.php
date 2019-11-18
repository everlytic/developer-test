<?php

namespace Tests\Unit;

use Everlytic\Repositories\UserListing\UserListingRepository;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class UserListingControllerTest extends TestCase
{
    use WithFaker;

    /**
     * Test Index (integration test)
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->json('GET', 'user-listings');
        $response->assertStatus(200);
        $response->assertViewHas('users');
    }

    /**
     * Test Create (integration test)
     *
     * @return void
     */
    public function testCreate()
    {
        $data = [
            '_token' => csrf_token(),
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->word,
            'email' => $this->faker->email,
            'position' => $this->faker->word,
        ];

        $response = $this->json('POST', 'user-listings', $data);
        $response->assertStatus(302);
        $response->isRedirection();
    }

    /**
     * Test Delete (integration test)
     *
     * @return void
     */
    public function testDelete()
    {
        $data = [
            '_token' => csrf_token(),
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->word,
            'email' => $this->faker->email,
            'position' => $this->faker->word,
        ];
        $data = new Request($data);

        $userListingRepo = new UserListingRepository();
        $userListing = $userListingRepo->createUserListing($data);

        $response = $this->delete('/user-listings/' . $userListing->id);
        $response->assertStatus(200);
        $response->isRedirection();
    }
}
