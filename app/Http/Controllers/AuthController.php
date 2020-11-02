<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public $successMsg = '';

    /**
     * Create a new user.
     *
     * @return void
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        try {
            //code...
            $newUser = new User;
            $newUser->name = $request->input('name');
            $newUser->email = $request->input('email');
            $newUser->password = Crypt::encrypt($request->input('password'));

            $newUser->save();

            // https://lumen.laravel.com/docs/5.1/responses#other-response-types
            return response()->json(
                [
                    'user' => $newUser,
                    'status' => true,
                    'message' => 'Registration created successful'
                ],
                200
            );
        } catch (\Exception $th) {
            //throw $th;
            dd($th);
            return response()->json(['message' => 'Registration failed!'], 401);
        }
    }
}
