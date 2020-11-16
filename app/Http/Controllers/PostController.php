<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'user_id' => 'required|integer|min:1',
            'title' => 'required|max:255',
            'description' => 'required|regex:/^([a-z0-9]+)$/'
        ];
        $validator = Validator::make($request->all(), $rules,  [
            'user_id.required' => 'You must select the author correctly.',
            'user_id.min' => 'You must use the author correctly.',
            'description.regex' => 'No HTML tags are allowed.'
        ]);
        if ($validator->fails()) {
            return response()->json(array("message"=> "The given data was invalid.", "errors" => $validator->getMessageBag()->getMessages()), 422);
        }
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
        $rules = [
            'user_id' => 'required|integer|min:1',
            'title' => 'required|max:255',
            'description' => 'required|regex:/^([a-z0-9]+)$/'
        ];
        $validator = Validator::make($request->all(), $rules,  [
            'user_id.required' => 'You must select the author correctly.',
            'user_id.min' => 'You must use the author correctly.',
            'description.regex' => 'No HTML tags are allowed.'
        ]);
        if ($validator->fails()) {
            return response()->json(array("message"=> "The given data was invalid.", "errors" => $validator->getMessageBag()->getMessages()), 422);
        }
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
