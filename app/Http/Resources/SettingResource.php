<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'id'=> $this->id,
            'footer_desc' => $this->footer_desc,
            'fb_link' => $this->fb_link,
            'insta_link' => $this->insta_link,
            'twiiter_link' => $this->tw_link,
            'youtube' => $this->you_link,
            'wha_link' => $this->wha_link,
            
        ];
    }
}