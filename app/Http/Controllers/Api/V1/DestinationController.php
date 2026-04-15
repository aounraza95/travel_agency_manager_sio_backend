<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\TravelPlan;
use App\Http\Requests\DestinationRequest;
use App\Http\Requests\DestinationSearchRequest;
use App\Services\DestinationService;

class DestinationController extends Controller
{
    protected $service;

    public function __construct(DestinationService $service)
    {
        $this->service = $service;
    }

    // resource methods
    public function index()
    {
        try {
            return $this->success($this->service->getAllDestinations());
        } catch (\Exception $e) {
            Log::error('Error fetching destinations: ' . $e->getMessage());
            return $this->error('Failed to fetch destinations', 500);
        }
    }

    public function show(TravelPlan $travelPlan)
    {
        try {
            return $this->success($this->service->getDestinationById($travelPlan));
        } catch (\Exception $e) {
            Log::error('Error fetching travel plan ID ' . $travelPlan->id . ': ' . $e->getMessage());
            return $this->error('Failed to fetch travel plan', 500);
        }
    }

    public function store(DestinationRequest $request)
    {
        try {
            $result = $this->service->createDestination($request->validated());
            return $this->success($result, 'Travel plan created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Error creating travel plan: ' . $e->getMessage());
            return $this->error('Failed to create travel plan', 500);
        }
    }

    public function update(DestinationRequest $request, TravelPlan $travelPlan)
    {
        try {
            $result = $this->service->updateDestination($travelPlan, $request->validated());
            return $this->success($result, 'Travel plan updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating travel plan ID ' . $travelPlan->id . ': ' . $e->getMessage());
            return $this->error('Failed to update travel plan', 500);
        }
    }

    public function destroy(TravelPlan $travelPlan)
    {
        try {
            $this->service->deleteDestination($travelPlan);
            return $this->success(null, 'Travel plan deleted successfully', 204);
        } catch (\Exception $e) {
            Log::error('Error deleting travel plan ID ' . $travelPlan->id . ': ' . $e->getMessage());
            return $this->error('Failed to delete travel plan', 500);
        }
    }

    public function getDestinationWithRelations(DestinationSearchRequest $request)
    {
        try {
            $result = $this->service->searchDestinations(
                $request->validated(),
                (int) $request->input('per_page', 10)
            );

            return $this->success($result);
        } catch (\Exception $e) {
            Log::error('Error searching destinations: ' . $e->getMessage());
            return $this->error('Search failed', 500);
        }
    }
}
