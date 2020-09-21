<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\Repository;
use App\UserPositions;

class UserListing extends Controller
{
    protected $model;
    
    public function __construct(User $user) 
    {
        $this->model = new Repository($user);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = $this->model->paginate(10);
        
        return view('user_listing')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required|string|max:50',
            'surname'=>'required|string|max:50',
            'email'=>'required|string|email|unique:users,email|max:255',
            'position'=>'required|string|max:50',
        ]);
        
        $request->merge(['password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm']); // secret
        
        $input = $request->all();
        
        $user = $this->model->create($input);
        
        if (!$user->id)
        {
            return response()->json(['error'=>'There was a problem creating the new user.']);
        }
        
        return response()->json(['success'=>'New user successfully added using the default password.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $d = $this->model->delete($id);
        
        if ((bool)$d === true) 
        {
            session()->flash('success', 'The user was deleted!');
            
            return redirect()->route('users.index');
        }
        else 
        {
            session()->flash('error', 'There was a problem deleting this user!');
            
            return redirect()->route('users.index');
        }
    }
}
