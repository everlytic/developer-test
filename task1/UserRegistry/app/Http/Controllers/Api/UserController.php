<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\Users;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Column field used to order results
        $orderField = ($request->has('orderBy')) ? $request->query('orderBy') : '';

        // Assign the order type (ascending or descending) value depending on the query parameter value received which is either 0 and 1
        // If value assigned is not integer, the default value will be "desc"
        $orderType = ($request->has('ascending') && is_numeric($request->query('ascending')) && $request->query('ascending') == 0) ? 'desc' : 'asc';

        // Start of search from
        $from = ($request->has('page') && is_numeric($request->query('page')) && $request->query('page') > 0) ? $request->query('page') : 1;

        // Maximum limit per page
        $limit = ($request->has('limit') && is_numeric($request->query('limit')) && $request->query('limit') > 0) ? $request->query('limit') : 10;

        // Sanitize input
        $orderField = filter_var($orderField, FILTER_SANITIZE_STRING);
        $orderType = filter_var($orderType, FILTER_SANITIZE_STRING);
        $from = filter_var($from, FILTER_SANITIZE_NUMBER_INT);
        $limit = filter_var($limit, FILTER_SANITIZE_NUMBER_INT);

        // Using there where clause
        if ($request->has('query') && $request->query('query') != "") {
            $q = filter_var($request->query('query'), FILTER_SANITIZE_STRING);
            $searched_value = '%' . $q . '%';

            // Run this query if orderby field does not exist
            if (!$request->has('orderBy')) {
                return UserCollection::collection(
                    User::where(function ($query) use ($searched_value) {
                        $query->where('id', 'like', $searched_value)
                            ->orwhere('first_name', 'like', $searched_value)
                            ->orwhere('last_name', 'like', $searched_value)
                            ->orWhere('email', 'like', $searched_value)
                            ->orWhere('position', 'like', $searched_value)
                            ->orWhere('created_at', 'like', $searched_value)
                            ->orWhere('updated_at', 'like', $searched_value);
                        })
                        ->offset($from)
                        ->limit($limit)
                        ->paginate($limit)
                );
            }

            return UserCollection::collection(
                User::where(function ($query) use ($searched_value) {
                    $query->where('id', 'like', $searched_value)
                        ->orwhere('first_name', 'like', $searched_value)
                        ->orwhere('last_name', 'like', $searched_value)
                        ->orWhere('email', 'like', $searched_value)
                        ->orWhere('position', 'like', $searched_value)
                        ->orWhere('created_at', 'like', $searched_value)
                        ->orWhere('updated_at', 'like', $searched_value);
                    })
                    ->orderby($orderField, $orderType)
                    ->offset($from)
                    ->limit($limit)
                    ->paginate($limit)
            );
        }

        if ($request->has('orderBy')) {
            //return UserCollection::collection(User::orderby($orderField, $orderType)->offset($from)->limit($limit)->paginate($limit));
            return UserCollection::collection(User::orderby($orderField, $orderType)->paginate($limit));
        }

        return UserCollection::collection(User::paginate($limit));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->save();

        return response([
            'message' => 'created'
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        return response([
            'message' => 'updated'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
