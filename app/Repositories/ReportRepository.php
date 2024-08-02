<?php

namespace App\Repositories;

use App\Contracts\ReportRepositoryInterface;
use App\Models\Report;
use Illuminate\Support\Facades\DB;


class ReportRepository implements ReportRepositoryInterface
{
    public function getAllReports()
    {
        return Report::all();
    }

    public function getReportsByDate()
    {
        return DB::table('reports')
            ->select(
                'date',
                DB::raw('SUM(revenue) as revenue'),
                DB::raw('SUM(impressions) as impressions'),
                DB::raw('SUM(revenue) * 1000 / SUM(impressions) as cpm')
            )
            ->groupBy('date')
            ->get();
    }

    public function createReport(array $data)
    {
        return Report::create($data);
    }

    public function reportExistsByDateAndWebsiteId($date, $website_id)
    {
        return Report::where('date', $date)
            ->where('website_id', $website_id)
            ->exists();
    }

    public function getReportByWebsiteId($id)
    {
        return Report::where('website_id', $id)->
            select([
                'date',
                'revenue',
                'impressions',
                DB::raw('(revenue * 1000 / NULLIF(impressions, 0)) as cpm')
            ])
            ->get();
    }


}
