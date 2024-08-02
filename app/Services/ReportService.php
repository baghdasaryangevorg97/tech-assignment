<?php

namespace App\Services;
use App\Contracts\ReportRepositoryInterface;

class ReportService
{
    protected $reportRepository;

    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function index()
    {
        $reports = $this->reportRepository->getAllReports();

        $data = $reports->keyBy('date');
        $totalRevenue = $reports->sum('revenue');
        $totalImpressions = $reports->sum('impressions');
        $totalCpm = $totalImpressions > 0 ? ($totalRevenue * 1000) / $totalImpressions : 0;

        $data = $reports->keyBy('date')->toArray();
        $total = [
            'sum' => $totalRevenue,
            'impressions' => $totalImpressions,
            'cpm' => $totalCpm
        ];

        return ['data' => $data, 'total' => $total];
    }

}
