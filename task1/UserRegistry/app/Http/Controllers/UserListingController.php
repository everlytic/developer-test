<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Repositories\UserListingRepo;
use App\UserListing;
use Illuminate\Http\Request;

class UserListingController extends Controller
{
    public $userListingRepo;

    public function __construct(UserListingRepo $userListingRepo)
    {
        $this->userListingRepo = new UserListingRepo();
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Repositories\UserListingRepo $userListingRepo
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userListingRepo->listAllUserListings();

        return view('user-listing', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateUser $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {
        $this->userListingRepo->createUserListing($request);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $this->userListingRepo->deleteUserListing($request);

        return redirect()->back();
    }
}
