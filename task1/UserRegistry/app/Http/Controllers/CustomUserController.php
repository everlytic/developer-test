<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Repositories\UserRepository;
use App\CustomUser;

class CustomUserController extends Controller {

	// space that we can use the repository from
   protected $userRepository;

   public function __construct(CustomUser $user)
   {
       // set the model
       $this->userRepository = new UserRepository($user);
   }

	/**
	 * Display a list of users in the database
	 * Uses latest() to fetch records by date in a DESC order
	 * Database paginate is used for paging
	 *
	 * @return html renders the user listing view
	 */
	public function index() {

		$users = $this->userRepository->latest()->paginate(15);
		return view('users', ['users' => $users]);
	}

	/**
	 * Save a CustomUser with the POST data using Request
	 * @param  Request $request The Request with post data from the form
	 * @return redirect           Redirect back to the user listing
	 */
	public function save(Request $request) {

		// See if the request method is POST
		if ($request->isMethod('post')) {
			$data = $request->validate([
				'firstname' => 'required|string|max:50',
				'lastname' => 'required|string|max:50',
		        'email' => 'required|email|unique:customusers',
		        'password' => 'string|min:5',
	            'position' => 'required|string|max:50',
		    ]);

			// Attempt to save the user with the input data
		    if ($user = tap($this->userRepository->create($data))) {
		    	// It was successful so we are storing a session flash message
		    	$request->session()->flash('alert-success', 'User was added');
		    } else {
		    	// Not successful, store an error message
		    	$request->session()->flash('alert-danger', 'Please fix the errors below');
		    }

		    // Redirect back to the index action/method of the CustomUser controller
		    return redirect()->action('CustomUserController@index');
		}
	}

	/**
	 * Delete a CustomUser by user id
	 * @param  Request $request The request data with the user parameter
	 * @return redirect           redirect back to the user listing
	 */
	public function delete(Request $request) {

		// The user ID comes from the route parameter
		$user_id = $request->route('user');
		if ($user = $this->userRepository->find($user_id)) {
			if ($this->userRepository->delete($user_id)) {
				$request->session()->flash('alert-success', 'User was deleted');
			} else {
				$request->session->flash('alert-danger', 'User not deleted');
			}
		} else {
			$request->session()->flash('alert-danger', 'User not found');
		}

		return redirect()->action('CustomUserController@index');
	}
}
