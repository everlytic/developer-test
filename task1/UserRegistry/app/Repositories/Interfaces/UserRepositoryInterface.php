<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Get all users
     */
    public function all();

    /**
     * Simple pagianted list of all users list of all users
     */
    public function paginate(int $perPage = 15);

    /**
     * Create a new user
     */
    public function create(array $data);

    /**
     * Delete a user.
     */
    public function destroy(int $id);
}
