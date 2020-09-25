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

    public function setUp()
    {
        parent::setUp();

    }


    public function testCreateUser()
    {
        $oldusers = User::all();
        $old_users_count = count($oldusers);

        $response = $this->followingRedirects()->post('/create', $this->data());

        $newusers = User::all();
        $new_users_count = count($newusers);

        $this->assertEquals($old_users_count + 1, $new_users_count);
        $response->assertStatus(200);
    }

    public function testValidationFirstname()
    {

        $oldusers = User::all();
        $old_users_count = count($oldusers);


        $response = $this->followingRedirects()->post('/create', array_merge($this->data(), [
            'firstname' => ''
        ]));

        $newusers = User::all();
        $new_users_count = count($newusers);

        $this->assertEquals($old_users_count, $new_users_count);
    }

    public function testValidationLastname()
    {

        $oldusers = User::all();
        $old_users_count = count($oldusers);


        $response = $this->followingRedirects()->post('/create', array_merge($this->data(), [
            'lastname' => ''
        ]));

        $newusers = User::all();
        $new_users_count = count($newusers);

        $this->assertEquals($old_users_count, $new_users_count);
    }

    public function testValidationEmail()
    {

        $oldusers = User::all();
        $old_users_count = count($oldusers);


        $response = $this->followingRedirects()->post('/create', array_merge($this->data(), [
            'email' => 'notanemail'
        ]));

        $newusers = User::all();
        $new_users_count = count($newusers);

        $this->assertEquals($old_users_count, $new_users_count);
    }

    public function testValidationPosition()
    {
        $oldusers = User::all();
        $old_users_count = count($oldusers);

        $response = $this->followingRedirects()->post('/create', array_merge($this->data(), [
            'position' => ''
        ]));

        $newusers = User::all();
        $new_users_count = count($newusers);

        $this->assertEquals($old_users_count, $new_users_count);
    }

    public function testDeleteUser()
    {
        $user = User::first();
        $response = $this->get('/delete/' . $user->id);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $response->assertStatus(302);
    }








    private function data()
    {
        return factory(User::class)->make()->toArray();
    }

}
