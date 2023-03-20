<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProducCatResource extends JsonResource
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
            'title' => $this->name,
            'description' => $this->description,
            'image' => $this->attachmentRelation[0]->path,
            'products' => $this->products->map(function ($item, $key) {

                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'category' => $item->category->name,
                    'original_price' => $item->price,
                    'selling_price' => $item->price_after_tax,
                    // 'rate' => $item->reviews->avg('rate'),

                    'image' => $item->attachmentRelation[0]->path,

                    'colors' => $item->productColors->map(function ($item, $key) {
                        return [
                            'id' => $item->color->id,
                            'color' => $item->color->code,
                        ];
                    }),
                ];

            }),
        ];

    }
}
