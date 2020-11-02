<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $newUser->password = app('hash')->make($request->input('password')); // Crypt::encrypt($request->input('password'));

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
            return response()->json(['message' => 'Registration failed!'], 401);
        }
    }

    /**
     * Login User
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginCreds = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($loginCreds)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Token generation for subsequent actions
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     * @param  string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
