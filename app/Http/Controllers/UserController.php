<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Fetch user's data
     * 
     * @return Response
     */
    public function getAllUsers()
    {
        return response()->json(['users' =>  User::all()], 200);
    }
}
