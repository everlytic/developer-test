<?php

namespace Tests\Feature;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserListingTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'UserSeeder']);
    }

    /**
     * Test we can get all listed users.
     *
     * @return void
     */
    public function testCanGetAllUsers()
    {
        $userRepository = App::make(UserRepositoryInterface::class);
        $users = $userRepository->all();

        // Database is seeded with 50 users
        $this->assertCount(50, $users);
    }

    /**
     * Test we can get paginated users.
     *
     * @return void
     */
    public function testCanGetPaginatedUsers()
    {
        $userRepository = App::make(UserRepositoryInterface::class);
        $users = $userRepository->paginate(25);

        $this->assertCount(25, $users);
    }
    
    /**
     * Test we can save using the repository.
     *
     * @return void
     */
    public function testCanSaveNewUser()
    {
        $userRepository = App::make(UserRepositoryInterface::class);

        $data = [
            'name'     =>  $this->faker->firstName(),
            'surname'      =>  $this->faker->lastName(),
            'email'         =>  $this->faker->unique()->safeEmail,
            'position'      =>  $this->faker->jobTitle(),
        ];
      
        $user = $userRepository->create($data);
      
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['surname'], $user->surname);
        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['position'], $user->position);
    }

    /**
     * Test we can save using the repository.
     *
     * @return void
     */
    public function testCanDeleteUser()
    {
        $userRepository = App::make(UserRepositoryInterface::class);
        $user = $userRepository->destroy(12);
        $this->assertTrue((bool)$user);
    }
}
