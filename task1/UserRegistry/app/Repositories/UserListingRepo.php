<?php
namespace App\Repositories;

use App\Http\Requests\CreateUser;
use App\UserListing;
use Illuminate\Http\Request;

class UserListingRepo
{
    public function listAllUserListings()
    {
        return UserListing::all();
    }

    public function createUserListing(CreateUser $request)
    {
        UserListing::create($request->all());
    }

    public function deleteUserListing(Request $request)
    {
        //        if you double click the button, technically this code could try run twice, triggering an error because $userListing doesn't exist anymore, so I added this check. I could have also just disabled the button after clicking it in javascript
        $userListing = UserListing::find($request->id);
        if (isset($userListing)) {
            $userListing->delete();
        }
    }
}