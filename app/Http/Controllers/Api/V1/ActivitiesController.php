<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Activity;
use App\Http\Requests\ActivityRequest;

class ActivitiesController extends Controller
{
    // resource methods
    public function index()
    {
        $activities = Activity::all();
        return $this->success($activities);
    }

    public function show(Activity $activity)
    {
        return $this->success($activity);
    }

    public function store(ActivityRequest $request)
    {
        $activity = Activity::create($request->validated());
        return $this->success($activity, 'Activity created successfully', 201);
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        $activity->update($request->validated());
        return $this->success($activity, 'Activity updated successfully');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return $this->success(null, 'Activity deleted successfully', 204);
    }
}
