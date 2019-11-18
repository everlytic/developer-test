<?php

namespace Everlytic\Http\Controllers;

use Everlytic\Http\Requests\StoreUserListing;
use Everlytic\Repositories\UserListing\UserListingInterface;



class UserListing extends Controller
{
    /** @var UserListingInterface */
    protected $userListingRepository;

    public function __construct(
        UserListingInterface $userListingRepository
    ) {
        $this->userListingRepository = $userListingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userListingRepository->userListings();

        return view("user-listing.index")
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user-listing.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Everlytic\Http\Requests\StoreUserListing $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserListing $request)
    {
        //validate
        $createUserListing = $this->userListingRepository->createUserListing($request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userListing = $this->userListingRepository->userListing($id);

        return view("user-listing.view")
            ->with('user', $userListing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userListing = $this->userListingRepository->userListing($id);

        return view("user-listing.edit")
            ->with('user', $userListing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Everlytic\Http\Requests\StoreUserListing $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserListing $request, $id)
    {
        //validate

        $updateUserListing = $this->userListingRepository->updateUserListing($request, $id);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userListingRepository->deleteUserListing($id);

        $users = $this->userListingRepository->userListings();
        return view("user-listing.index")
            ->with('users', $users);
    }
}
