<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartDetailsResource extends JsonResource
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
                    'title' => $this->products->title,
                    'price'=> $this->price,
                    'quantity'=> $this->quantity,
                    'sub_total'=>$this->sub_total

            
            
        ];
    }
}
