<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class USerRepository implements UserRepositoryInterface
{
    /**
     * Get all users
     *
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Store a new user record in the database
     *
     * @param array $data Validated user data to be saved
     *
     * @return App\User
     */
    public function create(array $data)
    {
        return User::create($data);
    }

    /**
     * Delete a user record in the database
     *
     * @param int $id User to be deleted
     *
     * @return App\User
     */
    public function destroy(int $id)
    {
        return User::destroy($id);
    }
}
