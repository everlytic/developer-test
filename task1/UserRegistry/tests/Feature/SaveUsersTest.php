<?php

namespace Tests\Unit;

use App\CustomUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\UserRepository;

class SaveUsersTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
   	public function it_can_create_a_user() 
    {
        $data = [
            'firstname'     =>  $this->faker->firstName(),
            'lastname'      =>  $this->faker->lastName(),
            'email'         =>  $this->faker->unique()->safeEmail,
            'password'      =>  $this->faker->password(),
            'position'      =>  $this->faker->jobTitle(),
        ];
      
        $userRepository = new UserRepository(new CustomUser);
        $user = $userRepository->create($data);
      
        $this->assertInstanceOf(CustomUser::class, $user);
        $this->assertEquals($data['firstname'], $user->firstname);
        $this->assertEquals($data['lastname'], $user->lastname);
        $this->assertEquals($data['email'], $user->email);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = factory(CustomUser::class)->create();
      
        $userRepository = new UserRepository($user);
        $delete = $userRepository->deleteUser();
        
        $this->assertTrue($delete);
    }
}
