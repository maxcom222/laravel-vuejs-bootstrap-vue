<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    /**
     * List of posts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created post in storage.
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
            return response()->json([
                "message"=> "The given data was invalid.",
                "errors" => $validator->getMessageBag()->getMessages()
            ], 422);
        }
        $post = Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description
        ]);;

        return new PostResource($post);
    }

    /**
     * Update the specified post in storage.
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
            return response()->json([
                "message"=> "The given data was invalid.",
                "errors" => $validator->getMessageBag()->getMessages()
            ], 422);
        }
        $post->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description
        ]);;

        return new PostResource($post);
    }

    /**
     * Remove the specified post from storage.
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
