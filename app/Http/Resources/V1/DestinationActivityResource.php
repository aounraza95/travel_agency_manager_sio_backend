<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationActivityResource extends JsonResource
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
            'cost' => $this->activity_cost,
            'reviews' => $this->reviews,
            'best_months' => $this->best_months,
            'is_active' => $this->is_active,
            'activity' => new ActivityResource($this->whenLoaded('activity')),
        ];
    }
}
