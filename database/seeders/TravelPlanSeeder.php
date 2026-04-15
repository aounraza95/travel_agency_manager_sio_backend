<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Travel Plans
        $tokyoPlan = \App\Models\TravelPlan::create([
            'city_id' => 1,
            'title' => 'Tokyo Explorer',
            'description' => 'A comprehensive 5-day journey through Tokyo\'s best spots.',
            'price' => 1500.00,
            'day_from' => '2026-10-01',
            'day_to' => '2026-10-05',
            'is_active' => true,
        ]);

        $parisPlan = \App\Models\TravelPlan::create([
            'city_id' => 2,
            'title' => 'Paris Romance',
            'description' => 'A romantic 3-day getaway in the City of Lights.',
            'price' => 2000.00,
            'day_from' => '2026-11-10',
            'day_to' => '2026-11-13',
            'is_active' => true,
        ]);

        $dubaiPlan = \App\Models\TravelPlan::create([
            'city_id' => 3,
            'title' => 'Dubai Luxury',
            'description' => 'Experience the luxury and desert adventures of Dubai.',
            'price' => 3500.00,
            'day_from' => '2026-12-05',
            'day_to' => '2026-12-10',
            'is_active' => true,
        ]);

        // 2. Link existing Tourist Spots to these plans
        \App\Models\TouristSpot::where('city_id', 1)->update(['travel_plan_id' => $tokyoPlan->id]);
        \App\Models\TouristSpot::where('city_id', 2)->update(['travel_plan_id' => $parisPlan->id]);
        \App\Models\TouristSpot::where('city_id', 3)->update(['travel_plan_id' => $dubaiPlan->id]);

        // 3. Link existing Destinations (destination_activities table) to these plans
        \App\Models\Destination::where('city_id', 1)->update(['travel_plan_id' => $tokyoPlan->id]);
        \App\Models\Destination::where('city_id', 2)->update(['travel_plan_id' => $parisPlan->id]);
        \App\Models\Destination::where('city_id', 3)->update(['travel_plan_id' => $dubaiPlan->id]);
    }
}
