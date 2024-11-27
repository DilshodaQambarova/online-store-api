<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = new User();
        $user->role_id = 3;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->verification_token = uniqid();
        $user->save();

        SendEmailJob::dispatch($user);

        return response()->json([
            'message' => 'User registered successfully'
        ], 201);
    }
    public function login(LoginRequest $request){
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'User not found or password is incorrect'
            ], 404);
        }
        if($user->email_verified_at == null){
            return response()->json([
                'message' => 'Email not verified'
            ], 403);
        }
        $token = $user->createToken('login')->plainTextToken;
        return response()->json([
            'message' => 'User logged successfully',
            'token' => $token
        ]);
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'User logged out successfully'
        ], 204);
    }
    public function verifyEmail(Request $request) {
        $user = User::where('verification_token', $request->token)->firstOrFail();
        $user->email_verified_at = now();
        $user->save();
        return response()->json([
            'message' => 'Email verified successfully'
        ]);
    }
}
