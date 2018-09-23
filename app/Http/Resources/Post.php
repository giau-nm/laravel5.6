<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Post extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'image' => $this->image,
            'video' => $this->video,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'user_id' => $this->user_id,
            'likes' => $this->likes,
            'comments' => $this->comments
        ];
    }
}
