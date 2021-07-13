<?php

namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'img' => asset('uploads')."/". $this->img,
            'price' => number_format($this->price,2),
            'sale_price' =>number_format( $this->sale_price,2),
            'discreption' => $this->discreption,
            'brand' => new BrandResource($this->brand),
            'category' => new CatResource($this->cat),
            'stock' => $this->stock,
            'model' => $this->model,
        ];
    }
}
