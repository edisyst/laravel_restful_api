<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['login', 'register']
        ]);
    }


    // registrazione con JWT
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'      => ['required', 'string', 'max:30'],
            'email'     => ['required', 'email',  'max:30', 'unique:users'],
            'password'  => ['required', 'string', 'confirmed'],
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::insert($data);

        return $this->login($request);

    }


    // Get a JWT via given credentials.
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized, invalid email or password'], 401);
        }

        return $this->respondWithToken($token);
    }


    // Get the authenticated User.
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }



    // Log the user out (Invalidate the token)
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    // Refresh a token.
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }


    // Get the token array structure.
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
