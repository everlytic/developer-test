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

    public function index()
    {
        $users = $this->user->all();

        return view('users.index', compact('users'));
    }

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
