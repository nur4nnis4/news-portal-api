<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('writer:id,username')->get();
        return PostDetailResource::collection($posts); //For json array

        // return response()->json(['data' => $posts]);
    }

    public function show(String $id)
    {
        // with(write:id,username)-> no space, id should be included
        $post = Post::with(['writer:id,username', 'comments.commenter'])->findOrFail($id);
        return new PostDetailResource($post); //For json object
    }

    public function store(StorePostRequest $request)
    {
        $request['author'] = Auth::user()->id;
        $post =  Post::create($request->all());

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function update(UpdatePostRequest $request, String $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function destroy(String $id)
    {
        $deletedPost = Post::findOrFail($id);
        $deletedPost->delete();

        return response()->json(['message' => 'success']);
    }
}
