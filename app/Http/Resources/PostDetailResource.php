<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'title' =>  $this->title,
            'image' => $this->image,
            'content' =>  $this->content,
            'author' => $this->whenLoaded('writer'), //Eager loading
            'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d'),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'total_comments' => $this->whenLoaded('comments', function () {
                return $this->comments->count();
            }),

            // 'comments' => $this->whenLoaded('comments', function () {
            //     return  collect($this->comments)->each(function ($comment) {
            //         $comment->commenter;
            //         return $comment;
            //     });
            // })
        ];
    }
}
