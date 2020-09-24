<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Get all users.
     *
     * @return array;
     */
    public function all()
    {
        return User::orderBy('firstname')
            ->get()
            ->toArray();
    }

    /**
     * Get a single user by id.
     *
     * @param Int $id;
     * @return array;
     */
    public function getById($id)
    {
        if(!is_numeric($id)) {
            return false;
        }

        return User::where('id', $id)
            ->first()
            ->toArray();
    }

    /**
     * Update a single user record by id.
     *
     * @param Request $request;
     * @return User;
     */
    public function create(Request $request)
    {
        $user = new User;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->position = $request->position;

        // We are currently not implementing the passwords but they cannot be null. It is probably a bad
        // idea to change the column to allow null, better to use random passwords for now
        // We shouldn't just hash a space or 1234, as we may overlook a password record later and it would be too easy to crack
        $user->password = Hash::make(uniqid());
        //$user->password = Hash::make($request->password);


        $user->save();
        return $user;
    }


    /**
     * Update a single user record by id.
     *
     * @param Int $id;
     * @return bool;
     */
    public function destroy($id)
    {
        if(!is_numeric($id)) {
            return false;
        }

        $user = User::find($id);


        if($user->delete()) {
            return true;
        }
        else {
            return false;
        }

    }


}
