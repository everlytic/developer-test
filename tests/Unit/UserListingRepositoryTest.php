<?php

namespace Tests\Unit;

use Everlytic\Repositories\UserListing\UserListingRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Everlytic\Models\UserListing;
use Illuminate\Pagination\LengthAwarePaginator;

class UserListingRepositoryTest extends TestCase
{
    use WithFaker;

    /**
     * Test Create User Listing
     *
     * @return void
     */
    public function testCreateUserListing()
    {
        $data = [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->word,
            'email' => $this->faker->email,
            'position' => $this->faker->word,
        ];
        $data = new Request($data);

        $userListingRepo = new UserListingRepository();
        $userListing = $userListingRepo->createUserListing($data);

        $this->assertInstanceOf(UserListing::class, $userListing);
        $this->assertEquals($data['name'], $userListing->name);
        $this->assertEquals($data['surname'], $userListing->surname);
        $this->assertEquals($data['email'], $userListing->email);
        $this->assertEquals($data['position'], $userListing->position);
    }

    /**
     * Test get User Listings Pagination
     *
     * @return void
     */
    public function testGetUserListings()
    {

        $userListingRepo = new UserListingRepository();
        $userListings = $userListingRepo->userListings();

        $this->assertInstanceOf(LengthAwarePaginator::class, $userListings);
    }

    /**
     * Test get User Listings Pagination
     *
     * @return void
     */
    public function testDeleteUserListings()
    {

        $data = [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->word,
            'email' => $this->faker->email,
            'position' => $this->faker->word,
        ];
        $data = new Request($data);

        $userListingRepo = new UserListingRepository();
        $userListing = $userListingRepo->createUserListing($data);
        $userListingDelete = $userListingRepo->deleteUserListing($userListing->id);
        $userListingByID = $userListingRepo->userListing($userListing->id);

        $this->assertInstanceOf(UserListing::class, $userListingDelete);
        $this->assertNull($userListingByID);
    }
}
