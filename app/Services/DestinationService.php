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
        return new TravelPlanResource($travelPlan->load(['city', 'touristSpots', 'destinations.activity']));
    }

    /**
     * Create a new travel plan.
     */
    public function createDestination(array $data): TravelPlanResource
    {
        $activityId = $data['activity_id'] ?? null;
        unset($data['activity_id']);

        $travelPlan = TravelPlan::create($data);

        if ($activityId) {
            $travelPlan->destinations()->create([
                'activity_id' => $activityId,
                'city_id' => $travelPlan->city_id,
                'is_active' => true,
            ]);
        }

        return new TravelPlanResource($travelPlan->load(['city', 'touristSpots', 'destinations.activity']));
    }

    /**
     * Update an existing travel plan.
     */
    public function updateDestination(TravelPlan $travelPlan, array $data): TravelPlanResource
    {
        $activityId = $data['activity_id'] ?? null;
        unset($data['activity_id']);

        $travelPlan->update($data);

        if ($activityId) {
            $destination = $travelPlan->destinations()->first();
            if ($destination) {
                $destination->update(['activity_id' => $activityId]);
            } else {
                $travelPlan->destinations()->create([
                    'activity_id' => $activityId,
                    'city_id' => $travelPlan->city_id,
                    'is_active' => true,
                ]);
            }
        }

        return new TravelPlanResource($travelPlan->load(['city', 'touristSpots', 'destinations.activity']));
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
            ->with(['destinations.activity', 'touristSpots', 'city'])
            ->when(!empty($filters['plan_name']), function ($query) use ($filters) {
                $query->where('title', 'LIKE', '%' . $filters['plan_name'] . '%');
            })
            ->when(!empty($filters['activity_id']), function ($query) use ($filters) {
                $query->whereHas('destinations', function ($q) use ($filters) {
                    $q->where('activity_id', $filters['activity_id']);
                });
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
