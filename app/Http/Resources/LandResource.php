<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LandResource extends JsonResource
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
            'state' => $this->state,
            'lga' => $this->lga,
            'area' => $this->area,
            'description' => $this->description,
            'facilities' => $this->facilities,
            'size' => $this->size,
            'available_plots' => $this->available_plots,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'photos' => '',
            'videos' => '',
            'installments' => '',
            'visits' => ''
        ];
    }
}
