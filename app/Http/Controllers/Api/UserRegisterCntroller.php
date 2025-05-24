<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRegisterCntroller extends Controller
{
    public function user_registration(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password'=> 'required|min:6',
            'role'=> 'required|in:teacher, staff'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' =>false,
                'message' => $validator->errors()->first
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role

        ]);

        return response()->json(['message' => 'User registered successfully!', 'user' => $user], 201);
    }
}
