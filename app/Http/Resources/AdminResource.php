<?php

namespace App\Http\Resources;

use App\Models\Code;
use App\Http\Resources\CodeResource;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'owner_name' => $this->owner_name,
            'phone owner number' => $this->phone_owner,
            'phone restaurant number' => $this->phone_restaurant,
            'code' =>  $this->restaurant_code,
            'subscription type' => $this->subscription->name,
            'status'    => $this->end_reg(),

            'start date' => $this->start_reg,
            'end date' => $this->end_reg
        ];
    }
}
