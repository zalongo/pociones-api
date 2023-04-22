<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'client_id' => $this->client_id,
            'total'     => $this->total,
            'potions'   => PotionsSaleResource::collection($this->whenLoaded('potions')),
            // 'potions'   => new PotionResource($this->potions),
            'client'    => new ClientResource($this->client),
        ];
    }
}
