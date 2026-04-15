<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\TravelPlan;

class DestinationService
{
    /**
     * Get all travel plans.
     */
    public function getAllDestinations(): Collection
    {
        return TravelPlan::all();
    }

    /**
     * Get a single travel plan.
     */
    public function getDestinationById(TravelPlan $travelPlan): TravelPlan
    {
        return $travelPlan;
    }

    /**
     * Create a new travel plan.
     */
    public function createDestination(array $data): TravelPlan
    {
        return TravelPlan::create($data);
    }

    /**
     * Update an existing travel plan.
     */
    public function updateDestination(TravelPlan $travelPlan, array $data): TravelPlan
    {
        $travelPlan->update($data);
        return $travelPlan;
    }

    /**
     * Delete a travel plan.
     */
    public function deleteDestination(TravelPlan $travelPlan): bool
    {
        return $travelPlan->delete();
    }

    /**
     * Search destinations with filters and pagination.
     */
    public function searchDestinations(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $query = TravelPlan::with(['destinations.activity', 'touristSpots', 'activity', 'city']);

        if (!empty($filters['city_id'])) {
            $query->where('city_id', $filters['city_id']);
        }

        if (!empty($filters['activity_id'])) {
            $query->where('activity_id', $filters['activity_id']);
        }

        if (!empty($filters['date_from'])) {
            $query->where('day_from', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where('day_to', '<=', $filters['date_to']);
        }

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        return $query->paginate($perPage);
    }
}
