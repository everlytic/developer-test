<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Get all users
     *
     * @return mixed
     */
    public function all();

    /**
     * Create a new user
     */
    public function create(array $data);

    /**
     * Delete a user.
     */
    public function destroy(int $id);
}
