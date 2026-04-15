<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelPlanResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'date_from' => $this->day_from->format('Y-m-d'),
            'date_to' => $this->day_to->format('Y-m-d'),
            'is_active' => $this->is_active,
            'city' => new CityResource($this->whenLoaded('city')),
            'activity' => new ActivityResource($this->whenLoaded('activity')),
            'tourist_spots' => TouristSpotResource::collection($this->whenLoaded('touristSpots')),
            'destinations' => DestinationActivityResource::collection($this->whenLoaded('destinations')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
