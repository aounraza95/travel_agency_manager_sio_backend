<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Http\Requests\CityRequest;
use App\Http\Traits\ApiResponseTrait;

class CityController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with('country')->get();
        return $this->success($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $city = City::create($request->validated());
        return $this->success($city, 'City created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return $this->success($city->load('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        return $this->success($city, 'City updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return $this->success(null, 'City deleted successfully', 204);
    }
}
