<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::where('mobile', $request->input('mobile'))->first();

        if (!$user) {
            $user = User::create([
                'mobile' => $request->input('mobile'),
            ]);
        }

        $otp = rand(1000, 9999);

        $user->otp = $otp;
        $user->save();
        //return response()->json(['message' => 'OTP sent successfully']);

        return redirect()->route('loginForm');
    }

    public function loginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'otp' => 'required',
        ]);
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user || !($request->otp == $user->otp)) {
            return response()->json(['message' => 'The provided credentials are incorrect.']);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
