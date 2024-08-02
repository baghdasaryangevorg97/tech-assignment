<?php

namespace App\Contracts;

use App\Models\Report;

interface ReportRepositoryInterface
{
    public function getAllReports();
    public function getReportById($id);
    public function createReport(array $data);
    public function updateReport($id, array $data);
    public function deleteReport($id);
}