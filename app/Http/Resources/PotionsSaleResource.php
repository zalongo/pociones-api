<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PotionsSaleResource extends JsonResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'quantity'    => $this->whenPivotLoaded('potion_sales', function () {
                return  $this->pivot->quantity;
            }),
            'total' => $this->whenPivotLoaded('potion_sales', function () {
                return  $this->pivot->total;
            }),
        ];
    }
}
