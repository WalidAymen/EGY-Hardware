<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'id' => $this->id,
            'total_price' => $this->total_price,
            'user' => new UserResource($this->user),
            'products'=>PivotProductResource::collection(($this->products()->get()))
        ];
    }
}
