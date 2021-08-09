<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class CacheController extends Controller
{

  public function getUserFromCache(){

        // return Cache::get('users');
        // return DB::table('users')->get();
        return User::all();
   }
}
