<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'title' =>  $this->title,
            'content' =>  $this->content,
            'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d'),
        ];

        // return parent::toArray($request);

    }
}
