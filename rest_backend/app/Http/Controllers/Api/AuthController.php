<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed', 
            'phone'                 => 'nullable|string',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'     => 'user', 
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registered successfully',
            'user'    => $user,
            'token'   => $token,
        ], 201);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

     
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Logged in successfully',
            'user'    => $user,
            'token'   => $token,
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }


    public function profile(Request $request)
    {
        return response()->json($request->user());
    }


    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'  => 'sometimes|string|max:255',
            'phone' => 'sometimes|string',
        ]);

        $user->update($request->only(['name', 'phone']));

        return response()->json([
            'message' => 'Profile updated successfully',
            'user'    => $user,
        ]);
    }
}