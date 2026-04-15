<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\City;
use App\Models\Activity;
use App\Models\ResidenceType;
use App\Models\ResidenceLocation;
use App\Models\TouristSpotType;
use App\Models\TouristSpot;
use App\Models\Destination;

class TravelAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Countries
        $japan = Country::create(['country_name' => 'Japan', 'country_code' => 'JP']);
        $france = Country::create(['country_name' => 'France', 'country_code' => 'FR']);
        $uae = Country::create(['country_name' => 'United Arab Emirates', 'country_code' => 'AE']);

        // 2. Cities
        $tokyo = City::create(['city_name' => 'Tokyo', 'city_code' => 'TYO', 'country_id' => $japan->id]);
        $paris = City::create(['city_name' => 'Paris', 'city_code' => 'PAR', 'country_id' => $france->id]);
        $dubai = City::create(['city_name' => 'Dubai', 'city_code' => 'DXB', 'country_id' => $uae->id]);

        // 3. Residence Types
        $hotel = ResidenceType::create(['type_name' => 'Hotel', 'type_code' => 'HTL']);
        $resort = ResidenceType::create(['type_name' => 'Resort', 'type_code' => 'RST']);
        $villa = ResidenceType::create(['type_name' => 'Villa', 'type_code' => 'VLA']);

        // 4. Residence Locations
        ResidenceLocation::create([
            'location_name' => 'Park Hyatt Tokyo',
            'location_address' => '3-7-1-2 Nishi Shinjuku, Shinjuku-ku',
            'is_active' => true,
            'location_type_id' => $hotel->id,
            'city_id' => $tokyo->id
        ]);
        ResidenceLocation::create([
            'location_name' => 'The Ritz Paris',
            'location_address' => '15 Place Vendôme',
            'is_active' => true,
            'location_type_id' => $hotel->id,
            'city_id' => $paris->id
        ]);
        ResidenceLocation::create([
            'location_name' => 'Burj Al Arab',
            'location_address' => 'Umm Suqeim 3',
            'is_active' => true,
            'location_type_id' => $resort->id,
            'city_id' => $dubai->id
        ]);

        // 5. Tourist Spot Types
        $landmark = TouristSpotType::create(['type_name' => 'Landmark', 'type_code' => 'LND']);
        $museum = TouristSpotType::create(['type_name' => 'Museum', 'type_code' => 'MSM']);
        $beach = TouristSpotType::create(['type_name' => 'Beach', 'type_code' => 'BCH']);

        // 6. Tourist Spots
        TouristSpot::create([
            'tourist_spot_name' => 'Tokyo Tower',
            'tourist_spot_address' => '4 Chome-2-8 Shibakoen, Minato City',
            'reviews' => '5',
            'tourist_spot_cost' => 1200,
            'is_active' => true,
            'city_id' => $tokyo->id,
            'tourist_spot_type_id' => $landmark->id
        ]);
        TouristSpot::create([
            'tourist_spot_name' => 'Eiffel Tower',
            'tourist_spot_address' => 'Champ de Mars, 5 Avenue Anatole France',
            'reviews' => '5',
            'tourist_spot_cost' => 25.00,
            'is_active' => true,
            'city_id' => $paris->id,
            'tourist_spot_type_id' => $landmark->id
        ]);
        TouristSpot::create([
            'tourist_spot_name' => 'Kite Beach',
            'tourist_spot_address' => 'Jumeirah',
            'reviews' => '4',
            'tourist_spot_cost' => 0.00,
            'is_active' => true,
            'city_id' => $dubai->id,
            'tourist_spot_type_id' => $beach->id
        ]);

        // 7. Activities
        $sightseeing = Activity::create(['activity_name' => 'Sightseeing', 'activity_code' => 'SGT', 'city_id' => $tokyo->id]);
        $shopping = Activity::create(['activity_name' => 'Shopping', 'activity_code' => 'SHP', 'city_id' => $dubai->id]);
        $fineDining = Activity::create(['activity_name' => 'Fine Dining', 'activity_code' => 'DIN', 'city_id' => $paris->id]);

        // 8. Destination Activities
        Destination::create([
            'activity_id' => $sightseeing->id,
            'activity_cost' => 5000,
            'reviews' => '5',
            'city_id' => $tokyo->id,
            'best_months' => ['March', 'April', 'October', 'November'],
            'is_active' => true
        ]);
        Destination::create([
            'activity_id' => $shopping->id,
            'activity_cost' => 10000,
            'reviews' => '4',
            'city_id' => $dubai->id,
            'best_months' => ['November', 'December', 'January', 'February'],
            'is_active' => true
        ]);
    }
}
