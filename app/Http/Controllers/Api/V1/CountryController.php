<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Http\Requests\CountryRequest;
use App\Http\Traits\ApiResponseTrait;

class CountryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        return $this->success($countries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $country = Country::create($request->validated());
        return $this->success($country, 'Country created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return $this->success($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        return $this->success($country, 'Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return $this->success(null, 'Country deleted successfully', 204);
    }
}
