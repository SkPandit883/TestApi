<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\View;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $responses =Post::with(['user','comments','views'])->get();
            return response()->json(['status' => 1, 'data' => $responses], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'error' => $th->getMessage()], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'integer|required',
                'content' => 'text|required',
            ]);
            $Post = Post::create($request->all());
            return response()->json(['status' => 1, 'data' => $Post, 'message' => 'data created successfully'], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'error' => $th->getMessage()], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $Post)
    {
        try {
            return response()->json(['status' => 1, 'data' =>$Post, 'message' => "show data"], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'error' => $th->getMessage()], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $Post)
    {
        try {
            $request->validate([
                'user_id' => 'integer|required',
                'content' => 'text|required',
            ]);
            $Post->update($request->all());
            return response()->json(['status' => 1, 'data' =>$Post, 'message' => 'data updated successfully'], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'error' => $th->getMessage()], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $Post)
    { 
        try {
            $Post->delete();
            return response()->json(['status' => 1, 'data' => null, 'message' => 'data deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'error' => $th->getMessage()], 200);
        }
    }

    public function userReport($userId,$postId){
        try {
                $Post=Post::withCount(['comments as total_comments'=>function($query) use ($userId){
                            $query->where('user_id',$userId);
                        }])->withSum(['views as total_views'=>function($query) use ($userId){
                            $query->where('user_id',$userId);
                        }],'view')->where('id',$postId)->get();
                
                return response()->json([
                    'status' => 1,
                    'data' =>$Post,
                    'message' => 'userReport'], 200);
        } catch (\Throwable $th) {
                return response()->json(['status' => 0, 'error' => $th->getMessage()], 200);
        }
    }

    public function postReport(Request $request){
        try {
                $post=Post::withCount('comments as total_comments')->withSum('views as total_views','view')->where('user_id',$request->userId)->get();
                return response()->json([
                    'status' => 1,
                    'data' =>$post,
                    'message' => 'postReport'], 200);
        } catch (\Throwable $th) {
                return response()->json(['status' => 0, 'error' => $th->getMessage()], 200);
        }
    }
}
