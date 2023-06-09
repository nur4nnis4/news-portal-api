<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required'
        ]);
        $request['user_id'] = auth()->user()->id;
        $comment = Comment::create($request->all());
        return new CommentResource($comment->loadMissing(['commenter:id,username']));
    }

    public function destroy(String $id)
    {
        $comment =  Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'success']);
    }
}
