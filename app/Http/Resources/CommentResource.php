<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'user_id' => $this->user_id,
            'commenter' => new UserResource($this->whenLoaded('commenter')),
            'created_at' => date_format($this->created_at, "Y-m-d H:i:s"),
        ];
    }
}
