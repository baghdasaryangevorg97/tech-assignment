<?php

namespace App\Http\Controllers\Web\Report;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{

    public function index()
    {
        return view('content.report.index');
    }

}
