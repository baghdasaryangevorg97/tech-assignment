<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $currentDate = Carbon::now();
        $startDate = $currentDate->copy()->subMonth()->startOfDay();

        $dates = [];

        for ($date = $startDate; $date <= $currentDate; $date->addDay()) {
            $dates[] = $date->copy()->format('Y-m-d'); 
        }

        $websiteIds = Website::pluck('id')->toArray();

        foreach ($dates as $date) {
            $reportsForDate = [];
            while (count($reportsForDate) < 2) {
                $randomKey = array_rand($websiteIds);
                $websiteId = $websiteIds[$randomKey];

                if(!Report::where('website_id', $websiteId)->where('date', $date)->exists()){
                    $reportsForDate[] = $websiteId;
                    Report::factory()->withCustomData($websiteId, $date)->create();
                }

            }
        }
       
    }
}
