<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('Accept-Language');

        return [
            'id'=>$this->id,

            'category'=>$this->category['name_'.$lang],
            'name_'.$lang =>$this['name_'.$lang],
            'text_'.$lang =>$this['text_'.$lang],
            'price'=>$this->price,
            'image'=>ImageResource::collection($this->images)

        ];
    }
}
