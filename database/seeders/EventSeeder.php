<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::truncate();

        $now = Carbon::now();

        // Calculate next Saturday
        $nextSaturday = $now->copy()->next(Carbon::SATURDAY)->setTime(8, 0, 0);

        // Calculate next Friday
        $nextFriday = $now->copy()->next(Carbon::FRIDAY)->setTime(20, 0, 0);

        // Calculate first Sunday of next month
        $firstSundayNextMonth = Carbon::create($now->year, $now->month + 1, 1)
            ->startOfMonth()
            ->next(Carbon::SUNDAY)
            ->setTime(6, 0, 0);

        Event::insert([
            [
                'title'       => 'Rawamangun Velodrome Track Day',
                'date'        => $nextSaturday,
                'description' => 'Open track session for fixed-gear riders. Bring your own helmet. Pacing groups from beginner to advanced. Limited slots — first come, first served.',
                'location'    => 'Velodrome Rawamangun, Jakarta Timur',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Jakarta Night Ride (JNR) — East Sector',
                'date'        => $nextFriday,
                'description' => 'Casual night ride starting from Crankhaus to Monas and back. Distance ±35 km. All bikes welcome. Lights and reflective gear required.',
                'location'    => 'Crankhaus (Start Point), Jl. Pemuda, Jakarta Timur',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Sunday Morning Alleycat Race',
                'date'        => $firstSundayNextMonth,
                'description' => 'High-speed urban checkpoint race through the streets of East Jakarta. Registration on site from 05:30. Prizes for top 3 finishers.',
                'location'    => 'Crankhaus Hub, Jakarta Timur',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
