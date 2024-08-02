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
        $reports = $this->reportRepository->getReportsByDate();

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

    public function getAll()
    {
        return $this->reportRepository->getAllReports();
    }

    public function createReport(array $data)
    {
        $date = $data['date'];
        $website_id = $data['website_id'];

        if (!$this->reportRepository->reportExistsByDateAndWebsiteId($date, $website_id)) {
            return $this->reportRepository->createReport($data);
        } 

        return ['error' => 'Report already exists'];
    }

}
