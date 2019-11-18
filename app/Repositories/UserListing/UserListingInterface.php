<?php

namespace Everlytic\Repositories\UserListing;

interface UserListingInterface
{
    public function createUserListing($request);

    public function userListings();

    public function userListing($id);

    public function deleteUserListing($id);

    public function updateUserListing($request, $id);

}