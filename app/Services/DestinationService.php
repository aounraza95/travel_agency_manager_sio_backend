<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\TravelPlan;
use App\Http\Resources\V1\TravelPlanResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DestinationService
{
    /**
     * Get all travel plans.
     */
    public function getAllDestinations(): AnonymousResourceCollection
    {
        return TravelPlanResource::collection(TravelPlan::all());
    }

    /**
     * Get a single travel plan.
     */
    public function getDestinationById(TravelPlan $travelPlan): TravelPlanResource
    {
        return new TravelPlanResource($travelPlan->load(['city', 'activity', 'touristSpots', 'destinations.activity']));
    }

    /**
     * Create a new travel plan.
     */
    public function createDestination(array $data): TravelPlanResource
    {
        return new TravelPlanResource(TravelPlan::create($data));
    }

    /**
     * Update an existing travel plan.
     */
    public function updateDestination(TravelPlan $travelPlan, array $data): TravelPlanResource
    {
        $travelPlan->update($data);
        return new TravelPlanResource($travelPlan);
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
    public function searchDestinations(array $filters, int $perPage = 10): AnonymousResourceCollection
    {
        $plans = TravelPlan::query()
            ->with(['destinations.activity', 'touristSpots', 'activity', 'city'])
            ->when(!empty($filters['plan_name']), function ($query) use ($filters) {
                $query->where('title', 'LIKE', '%' . $filters['plan_name'] . '%');
            })
            ->when(!empty($filters['activity_id']), function ($query) use ($filters) {
                $query->where('activity_id', $filters['activity_id']);
            })
            ->when(!empty($filters['date_from']), function ($query) use ($filters) {
                $query->where('day_from', '>=', $filters['date_from']);
            })
            ->when(!empty($filters['date_to']), function ($query) use ($filters) {
                $query->where('day_to', '<=', $filters['date_to']);
            })
            ->when(!empty($filters['budget_min']), function ($query) use ($filters) {
                $query->where('price', '>=', $filters['budget_min']);
            })
            ->when(!empty($filters['budget_max']), function ($query) use ($filters) {
                $query->where('price', '<=', $filters['budget_max']);
            })
            ->when(isset($filters['is_active']), function ($query) use ($filters) {
                $query->where('is_active', $filters['is_active']);
            })
            ->paginate($perPage);

        return TravelPlanResource::collection($plans);
    }
}
