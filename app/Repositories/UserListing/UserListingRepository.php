<?php

namespace Everlytic\Repositories\UserListing;

use Everlytic\Models\UserListing;


/**
 * Class UserListingRepository
 * @package Everlytic\Repositories\UserListing
 */
class UserListingRepository implements UserListingInterface
{
    /**
     * @param $request
     * @return UserListing
     */
    public function createUserListing($request)
    {
        $userListing = new UserListing();
        $userListing->name = $request->name;
        $userListing->surname = $request->surname;
        $userListing->email = $request->email;
        $userListing->position = $request->position;
        $userListing->save();

        return $userListing;
    }

    /**
     * @return mixed
     */
    public function userListings()
    {
        return UserListing::orderBy('id', 'DESC')->paginate(7);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function userListing($id)
    {
        $userListing = UserListing::find($id);

        return $userListing;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteUserListing($id)
    {
        $userListing = UserListing::find($id);
        $userListing->delete();

        return $userListing;
    }

    /**
     * @param $request
     * @param $id
     */
    public function updateUserListing($request, $id)
    {
        $userListing = new UserListing();
        $userListing->name = $request->name;
        $userListing->surname = $request->surname;
        $userListing->email = $request->email;
        $userListing->position = $request->position;
        $userListing->update();
    }
}