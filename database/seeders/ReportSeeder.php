<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2024, 3, 1);
        $endDate = Carbon::create(2024, 4, 12);
        $dateRange = $endDate->diffInDays($startDate);

        for ($i = 1; $i <= 100; $i++) { 
            for ($j = 0; $j <= $dateRange; $j++) {
                $date = $startDate->copy()->addDays($j)->format('Y-m-d');
                if (!Report::where('website_id', $i)->where('date', $date)->exists()) {
                    Report::factory()->create([
                        'website_id' => $i,
                        'date' => $date,
                    ]);
                }
            }
        }
    }
}
