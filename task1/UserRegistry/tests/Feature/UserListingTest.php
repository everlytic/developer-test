<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class UserTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

    }


    public function test_index_lists_users()
    {
        $data = factory(User::class, 10)->create();
        $users = $data->toArray();
        //$this->assertDatabaseCount('users', 10); //not available in this version of Laravel?
        $response = $this->followingRedirects()->get('/');
        $response->assertSee($users[0]['firstname'] . " " . $users[0]['lastname']);
        $response->assertStatus(200);
    }


    public function test_a_user_is_created()
    {
        $data = $this->data();
        $response = $this->followingRedirects()->post('/create', $data);
        $this->assertDatabaseHas('users', $data);
        $response->assertStatus(200);
    }

    public function test_validation_firstname_supplied()
    {
        $data = array_merge($this->data(), [
            'firstname' => ''
        ]);
        $response = $this->followingRedirects()->post('/create', $data);
        $this->assertDatabaseMissing('users', $data);
        $response->assertStatus(200);
    }

    public function test_validation_lastname_supplied()
    {
        $data = array_merge($this->data(), [
            'lastname' => ''
        ]);
        $response = $this->followingRedirects()->post('/create', $data);
        $this->assertDatabaseMissing('users', $data);
        $response->assertStatus(200);
    }

    public function test_validation_email_supplied()
    {
        $data = array_merge($this->data(), [
            'email' => ''
        ]);
        $response = $this->followingRedirects()->post('/create', $data);
        $this->assertDatabaseMissing('users', $data);
        $response->assertStatus(200);
    }

    public function test_validation_email_valid()
    {
        $data = array_merge($this->data(), [
            'email' => 'thisisnotanemail'
        ]);
        $response = $this->followingRedirects()->post('/create', $data);
        $this->assertDatabaseMissing('users', $data);
        $response->assertStatus(200);
    }

    public function test_validation_position_supplied()
    {
        $data = array_merge($this->data(), [
            'position' => ''
        ]);
        $response = $this->followingRedirects()->post('/create', $data);
        $this->assertDatabaseMissing('users', $data);
        $response->assertStatus(200);
    }

    public function test_created_user_is_deleted()
    {

        $data = factory(User::class)->create()->toArray();
        $this->assertDatabaseHas('users', $data);

        $response = $this->followingRedirects()->get('/delete/' . $data['id']);
        $this->assertDatabaseMissing('users', ['id' => $data['id']]);
        $response->assertStatus(200);
    }


    private function data()
    {
        return factory(User::class)->make()->toArray();
    }

}
