<?php

namespace App\Services;
use App\Contracts\WebsiteRepositoryInterface;


class WebsiteService
{

    protected $websiteRepository;
    protected $reportService;

    public function __construct(WebsiteRepositoryInterface $websiteRepository, ReportService $reportService)
    {
        $this->websiteRepository = $websiteRepository;
        $this->reportService = $reportService;
    }

    public function index()
    {
        return $this->websiteRepository->getWebsites(20);
    }

    public function create(array $data)
    {
        return $this->websiteRepository->create($data);
    }

    public function showReport(int $id)
    {
        $reports = $this->reportService->getReportByWebsiteId($id);

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

    public function edit(int $id, string $url)
    {
        return $this->websiteRepository->edit($id, $url);
    }

    public function destroy(int $id)
    {
        return $this->websiteRepository->destroy($id);
    }
    
}
