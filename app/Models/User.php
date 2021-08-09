<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use App\Models\Comment;
use App\Models\View;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    public function posts(){
        return $this->hasMany(Post::class,'user_id');
    }  
    public function comments(){
        return $this->hasMany(Comment::class,'user_id');
    } 
     public function views(){
        return $this->hasMany(View::class,'user_id');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}
