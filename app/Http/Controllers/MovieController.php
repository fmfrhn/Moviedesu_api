<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function search(Request $request)
    {
        // Validasi parameter pencarian
        $request->validate([
            's' => 'required|string'
        ]);

        // Ambil parameter pencarian dari query string
        $search = $request->input('s');

        // Panggil API menggunakan HTTP Client Laravel
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => 'b3799065',
            's' => $search
        ]);

        // Jika permintaan sukses
        if ($response->successful()) {
            $omdbResp = $response->json();
            if ($omdbResp['Response']  == "False") {
                return response()->json([
                    'status' => false,
                    'message' => 'Movie tidak ditemukan!'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Daftar movie berhasil dimuat!',
                'data' => $omdbResp['Search'] 
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data dari OMDb API'
            ], $response->status());
        }
    }

    public function detail(Request $request) {
        // Validasi parameter pencarian
        $request->validate([
            'i' => 'required|string'
        ]);

        // Ambil parameter pencarian dari query string
        $search = $request->input('i');

        // Panggil API menggunakan HTTP Client Laravel
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => 'b3799065',
            'i' => $search
        ]);

        // Jika permintaan sukses
        if ($response->successful()) {
            $omdbResp = $response->json();
            if ($omdbResp['Response']  == "False") {
                return response()->json([
                    'status' => false,
                    'message' => 'imdbID tidak ditemukan!'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Detail movie berhasil dimuat!',
                'data' => $omdbResp
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data dari OMDb API'
            ], $response->status());
        }
    }
}
