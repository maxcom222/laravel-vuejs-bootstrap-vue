<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::all()->load('user');
        $result = [];
        foreach ($posts as $post) {
            array_push($result, [
                'id' => $post->id,
                'user_id' => $post->user_id,
                'user_name' => $post->user->name,
                'title' => $post->title,
                'description' => $post->description,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'action' => $post->id,
            ]);
        }

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        $post = Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description
        ]);;

        return response()->json($post->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        $post->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description
        ]);;

        return response()->json($post->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
