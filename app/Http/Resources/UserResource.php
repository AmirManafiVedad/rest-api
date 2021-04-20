<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class UserResource extends JsonResource
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
        'username' => $this->resource->name,
        'email' => $this->resource->email,
        'articles' => $this->whenLoaded('articles' , function () use($request){
           return $request->with === 'articles' ? ArticleResource::collection($this->articles) : new MissingValue();
        }),
            $this->mergeWhen($this->id === 1 , [
                                'type' => 'You Are Admin'
                ]),
            ];
    }
    public function with($request)
    {
        return [
            'foo' => 'amir',
            'Raman' => ['name' => 'Amir Manafi Vedad'],
//            'relations' => [
//                'articles' => $this->resource->articles,
//            ]

        ];
    }
}
