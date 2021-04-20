<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->resource->id,
          'title' => $this->resource->title,
          'body' => $this->resource->body,
          'user' => $this->whenLoaded('user' , new UserResource($this->user)),
        ];
    }
}
