<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WatchlistController extends Controller
{
    public function addWatchlist(Request $request){
       try {
        $validatedData = $request->validate([
            'imdb_id'=>'string',
            'user_id'=>'integer',
            'title'=>'string',
            'poster'=>'string',
        ]);
        
        Watchlist::create($validatedData);

        return response()->json(['status'=>true , 'message'=>'berhasil menambah watchlist!'], 200);
       } catch (\Throwable $th) {
        return response()->json(['status'=>false, 'message' => $th],500);
       }
    }

    public function showWatchlist(Request $request){
        $user_id = $request->uid;
        $result = Watchlist::where('user_id',$user_id)->get();
        
        return response()->json([
            'status' => true,
            'messsage'=> 'watchlist berhasil ditampilkan',
            'data' => $result
        ]);
    }
    
    public function deleteWatchlist(Request $request, int $id){
        $result = Watchlist::where('id',$id)->delete();

        if($result){
            return response()->json([
                'status' => true,
                'messsage'=> 'watchlist berhasil dihapus',
            ]);
        }

        return response()->json([
            'status' => false,
            'messsage'=> 'watchlist gagal dihapus, data tidak ditemukan!',
        ]);

       
    }
}
