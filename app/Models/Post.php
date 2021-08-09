<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\View;
use App\Models\User;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory,Searchable;
    protected $guarded=[];

    public function comments(){
        return $this->hasMany(Comment::class,'post_id');
    }
    public function views(){
        return $this->hasMany(View::class,'post_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function toSearchableArray()
    {
        $array = $this->toArray();
        // Customize the data array...
        return $array;
    }
}
