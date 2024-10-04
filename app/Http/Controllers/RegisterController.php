<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "email" => "required|email|unique:users",
                "name" => "string|max:150",
                "password" => "required"
            ],);
    
            User::create($validatedData);
            return response()->json(['status'=>true , 'message'=>'Registrasi berhasil'],200);
        } 
        // catch (ValidationException $e) {
        //     // Tangkap exception validasi dan kembalikan pesan khusus
        //     return response()->json([
        //         'status' => false, 
        //         'message' => 'Registrasi gagal!', 
        //         'errors' => $e->error() // Mengembalikan pesan error dari validasi
        //     ], 400);
        // } 
        catch (\Exception $e) {
            // Tangani exception lainnya
            return response()->json(['status' => false, 'message' => 'email telah digunakan!'], 500);
        }
       
    }
}
