<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResources;
class AuthController extends Controller
{
    public function CreateUser(SignupRequest $request){

        $data = $request->validated();
        $user = User::create($data);
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'status' =>true,
            'user' => UserResources::make($user),
        ], 201);

    }
    public function GetUserData(){
        $user = auth('userapi')->user();
        return UserResources::make($user);
    }

    public function CreateAdmin(SignupRequest $request){

        $data = $request->validated();
        $user = Admin::create($data);
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'status' =>true,
            'user' => $user,
        ], 201);

    }
}
