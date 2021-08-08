<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class CacheController extends Controller
{
  public function testCache($name){
       Cache::put('user',$name,10);
       if(Cache::has('user')){
           return "cache has ".Cache::get('user');
       }else{
           return 'cache has no key user';
       }
  }
}
