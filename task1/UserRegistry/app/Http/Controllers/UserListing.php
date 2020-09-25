<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

//use App\Models\User;
//use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;

class UserListing extends Controller
{
    private $userRepository;
    /**
     * Constructor method that instantiates the database repository
     *
     * @return App\Repositories\UserRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Display a listing of all the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = $this->userRepository->all();
        }
        catch(\Exception $e){
            $users = [];
            $error = $e->getMessage();
            //Route to error page
        }

        return view('user.index')
        ->with('users', $users);

    }

    /**
     * Show the form for creating a new user.
     *
     * @param Request $request;
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'position' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return redirect()
                ->to('/')
                ->with('modalerror', "Sorry, there was an error so we couldn't save your user. Please check your input and try again.")
                ->withInput();
        }

        try {
            $users = $this->userRepository->create($request);
        }
        catch(\Exception $e){
            $error = $e->getMessage();

            return redirect()
                ->to('/')
                ->with('modalerror', "Sorry, there was an error so we couldn't save your user. Please check your input and try again.")
                ->withInput();
        }

        return redirect()
            ->to('/')
            ->with('success', $request->firstname . " " . $request->lastname .  " was added successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        if(!is_numeric($id)) {
            return redirect()
                ->to('/')
                ->with('error', "Sorry, there was an error so we couldn't delete your user.");
        }

        $user = $this->userRepository->getById($id);
        $name = $user['firstname'] . " " . $user['lastname'];

        try {
            $this->userRepository->destroy($id);
        }
        catch(\Exception $e){
            $error = $e->getMessage();

            return redirect()
                ->to('/')
                ->with('error', "Sorry, there was an error so we couldn't delete your user.");
        }

        return redirect()
            ->to('/')
            ->with('success', $name . " was deleted successfully.");
    }
}
