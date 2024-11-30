<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
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

        return $this->success([],'User registered successfully', 201);
    }
    public function login(LoginRequest $request){
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return $this->error('User not found or password is incorrect', 404);
        }
        if($user->email_verified_at == null){
            return $this->error('Email not verified', 403);
        }
        $token = $user->createToken($user->first_name)->plainTextToken;
        return $this->success($token, 'User logged successfully');
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return $this->success([], 'User logged out successfully', 204);
    }
    public function verifyEmail(Request $request) {
        $user = User::where('verification_token', $request->token)->first();
        if(!$user){
            return $this->error('User not found', 404);
        }
        $user->email_verified_at = now();
        $user->save();
        return $this->success([], 'Email verified successfully');
    }
    public function getUser(Request $request){
        $user = $request->user();
        if(!$user){
            return $this->error('User not found', 404);
        }
        return $this->success(new UserResource($user));
    }
}
