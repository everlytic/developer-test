<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    use WithoutMiddleware;
    
    protected static $alreadySetup = false;

    public function setUp()
    {
        parent::setUp();
        
        if (!static::$alreadySetup)
        {
            Artisan::call('migrate:fresh');
            
            $users = factory(User::class, 100)->create();
            
            static::$alreadySetup = true;
        }
        
    }
    
    /**
     * Test creation of 100 users
     */
    public function test_create_users() 
    {
        $chk = User::all();
        
        $this->assertCount(100, $chk);
    }
    
    /**
     * Test a blank post fails
     */
    public function test_blank_post()
    {
        $response = $this->json('POST', '/users', []);
        
        $response->assertStatus(422);
        
    }

    /**
     * Test deleting 1 user
     */
    public function test_delete_user()
    {
        $id = rand(1, 10);
        
        $response = $this->json('DELETE', 'users/' . $id, []);
        
        $this->assertDatabaseMissing('users', ['id'=> $id]);
        
    }
    
    /**
     * Test a new user created
     */
    public function test_new_user()
    {
        $response = $this->json('POST', '/users', ['name'=>'Rick', 'surname'=>'Astley', 'email'=>'rick.astley@example.org', 'position'=>'Singer']);
        
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'success' => 'New user successfully added using the default password.',
            ]);
    }
}
