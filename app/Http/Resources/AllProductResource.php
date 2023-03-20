<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllProductResource extends JsonResource
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
                    'title' => $this->title,
                    'category' => $this->category->name,
                    'original_price' => $this->price,
                    'selling_price' => $this->price_after_tax,
                    'rate' => $this->reviews->avg('rate'),

                    'image' => $this->attachmentRelation[0]->path,

                    'colors' => $this->productColors->map(function ($item, $key) {
                        return [
                            'id' => $item->color->id,
                            'color' => $item->color->code,
                        ];
                    }),
            ];
    }
}
