<?php

namespace Tests\Feature;

use App\Http\Controllers\UserListing;
use Mockery as m;
use Tests\TestCase;

class UserListingTest extends TestCase
{

    private $postRepository;
    private $postController;

    public function setUp()
    {
        parent::setup();
        $this->postRepository = m::mock('App\Repositories\Interfaces\UserRepositoryInterface');
            
        // inject the mocked version of the repository
        $this->postController = new UserListing($this->postRepository);
    }

    public function tearDown()
    {
        m::close();
        parent::tearDown();
    }
        
    public function testIndex()
    {
        $this->postRepository->shoudlReceive('/')->once()->andReturn(array());
        $response = $this->postController->index();
        $this->assertEqual(array(), $response);
    }
}
