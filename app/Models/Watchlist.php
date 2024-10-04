<?php

namespace App\Models;

// use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    protected $table = 'watchlists'; 
    protected $fillable = [
        'imdb_id',
        'user_id',
        'poster',
        'title',
        
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
