<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\Store;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserListing extends Controller
{
    /**
     * Repository for controller
     *
     * @var UserRepositoryInterface
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @param UserRepositoryInterface $user

     * @return void
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Gets sorted list of all users in the database
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        for ($i = 1; $i <= 100; $i++) {
            $multipleOfThree = (($i % 3) === 0);
            $multipleOfFive = (($i % 5) === 0);

            if (!$multipleOfThree && !$multipleOfFive) {
                print $i . "<br/>";

                // No need to evaluate further
                continue;
            }

            if ($multipleOfThree) {
                print('Fizz');
            }

            if ($multipleOfFive) {
                print('Buzz');
            }

            print("<br/>");
        }


        // $users = $this->user->paginate(10);
        
        // return view('users.index', compact('users'));
    }

    /**
     * Store newly created user in the database
     *
     * @param App\Http\Requests\Users\Store $request Incomming request
     *
     * @return App\User
     */
    public function store(Store $request)
    {
        // Get our validated data from the request
        $validated = $request->validated();
        
        return $this->user->create($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user Entity to be destroyed
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        return $this->user->destroy($user->id);
    }
}
