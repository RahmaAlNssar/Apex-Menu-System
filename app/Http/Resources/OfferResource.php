<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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

            'name_'.$lang =>$this['name_'.$lang],
            'first_title_'.$lang =>$this['first_title_'.$lang],
            'second_title_'.$lang =>$this['second_title_'.$lang],
            'third_title_'.$lang =>$this['third_title_'.$lang],
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'image'=>ImageResource::collection($this->images)

        ];
    }
}
