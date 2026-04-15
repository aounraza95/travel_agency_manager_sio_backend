<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TouristSpotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->tourist_spot_name,
            'address' => $this->tourist_spot_address,
            'reviews' => $this->reviews,
            'cost' => $this->tourist_spot_cost,
            'is_active' => $this->is_active,
        ];
    }
}
