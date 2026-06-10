<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bus = Bus::create([
            'name'        => 'Sumber Alam',
            'bus_number'  => 'SA-001',
            'bus_class'   => 'executive',
            'total_seats' => 40,
        ]);

        $route = Route::create([
            'origin'             => 'Solo',
            'destination'        => 'Jakarta',
            'distance_km'        => 560,
            'estimated_duration' => 480,
        ]);

        Schedule::create([
            'bus_id'          => $bus->id,
            'route_id'        => $route->id,
            'departure_time'  => now()->addDays(2)->setTime(8, 0),
            'arrival_time'    => now()->addDays(2)->setTime(16, 0),
            'price'           => 150000,
            'available_seats' => 40,
            'status'          => 'active',
        ]);
    }
}
