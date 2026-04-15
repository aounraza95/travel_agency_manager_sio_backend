<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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
        $destinations = $this->service->getAllDestinations();
        return $this->success($destinations);
    }

    public function show(TravelPlan $travelPlan)
    {
        return $this->success($this->service->getDestinationById($travelPlan));
    }

    public function store(DestinationRequest $request)
    {
        $travelPlan = $this->service->createDestination($request->validated());
        return $this->success($travelPlan, 'Travel plan created successfully', 201);
    }

    public function update(DestinationRequest $request, TravelPlan $travelPlan)
    {
        $travelPlan = $this->service->updateDestination($travelPlan, $request->validated());
        return $this->success($travelPlan, 'Travel plan updated successfully');
    }

    public function destroy(TravelPlan $travelPlan)
    {
        $this->service->deleteDestination($travelPlan);
        return $this->success(null, 'Travel plan deleted successfully', 204);
    }

    // Setup function to get descriptoin with all it's relations table data for user
    public function getDestinationWithRelations(DestinationSearchRequest $request)
    {
        $destinations = $this->service->searchDestinations(
            $request->validated(),
            (int) $request->input('per_page', 10)
        );

        return $this->success($destinations);
    }
}
