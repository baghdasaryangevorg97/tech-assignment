<?php

namespace App\Contracts;

use App\Models\Report;
use Carbon\Carbon;

interface ReportRepositoryInterface
{
    public function getAllReports();
    public function getReportsByDate();
    public function createReport(array $data);

    public function reportExistsByDateAndWebsiteId(Carbon $date, int $website_id);
    
}