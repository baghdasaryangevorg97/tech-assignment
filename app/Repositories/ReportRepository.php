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
        return Report::select([
            'date',
            'revenue',
            'impressions',
            DB::raw('(revenue * 1000 / NULLIF(impressions, 0)) as cpm')
        ])
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
