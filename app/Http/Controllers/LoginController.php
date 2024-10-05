<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // $user = Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // return response()->json(['status'=>'ok']);

        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $token = $request->user()->createToken(auth()->user()->id);

            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'id' => $request->user()->id,
                'email' => $request->user()->email,
                'name' => $request->user()->name,
                'token' => $token->plainTextToken
        ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'email & dan password salah'
        ], 401);
    }

}
