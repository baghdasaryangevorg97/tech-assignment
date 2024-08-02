<?php

namespace App\Repositories;

use App\Contracts\ReportRepositoryInterface;
use App\Models\Report;
use Illuminate\Support\Facades\DB;


class ReportRepository implements ReportRepositoryInterface
{
    public function getAllReports()
    {
        return Report::select([
                'date',
                'revenue',
                'impressions',
                DB::raw('(revenue * 1000 / NULLIF(impressions, 0)) as cpm')
            ])
            ->get();
    }

    public function getReportById($id)
    {
        return Report::findOrFail($id);
    }

    public function createReport(array $data)
    {
        return Report::create($data);
    }

    public function updateReport($id, array $data)
    {
        $report = Report::findOrFail($id);
        $report->update($data);
        return $report;
    }

    public function deleteReport($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return $report;
    }
}
