<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User; 

class LoginRegisterController extends Controller
{
  
    public function register(RegisterRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        // Create a new user
        $user = User::create([
            'username' => $credentials->username,
            'firstname' => $credentials->firstname,
            'lastname' => $credentials->lastname,
            'email' => $credentials->email,
            'password' => Hash::make($credentials->password)
        ]);

        if (!$user) {
            // Handle the case where user creation failed
            return response()->json([
                'success' => false,
                'message' => 'User registration failed',
            ], 500);
        }

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $user, // Optionally return the created user data
        ], 200);
    }

  
    public function authenticate(LoginRequest $request): JsonResponse
    {
        $userData = $request->validated();

        if (Auth::attempt($userData)) {
            $user = Auth::user();
         
            return ApiResponse::success(
                'User logged in successfully'
            );
        }

        return response()->json([
            'success' => false,
            'message' => "Invalid Details"
        ], 401);
    }

  
  
      
   

}