<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class USerRepository implements UserRepositoryInterface
{
    /**
     * Get all users - Sorted by created_at desc
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return User::orderby('created_at', 'desc')
            ->get();
    }

    /**
     * Simple pagianted list of all users - Sorted by created_at desc
     *
     * @param int $perPage Number of records per page
     *
     * @return Illuminate\Pagination\Paginator
     */
    public function paginate(int $perPage = 15)
    {
        return User::orderby('created_at', 'desc')
            ->simplePaginate($perPage);
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
     * @return bool
     */
    public function destroy(int $id)
    {
        return User::destroy($id);
    }
}
