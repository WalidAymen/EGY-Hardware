<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'phone3' => $this->phone3,
            'phone4' => $this->phone4,
            'phone5' => $this->phone5,
            'phone6' => $this->phone6,
            'facebook' => $this->facebook,
            'youtube' => $this->youtube,
            'googleplus' => $this->googleplus,
            'insta' => $this->insta,
            'twitter' => $this->twitter,
            'tiktok' => $this->tiktok,
            'snap' => $this->snap,
            'whatsapp' => $this->whatsapp,
        ];
    }
}
