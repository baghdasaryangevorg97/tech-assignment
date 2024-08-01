<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function show(Request $request)
    {
        $reports = DB::table('reports')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(revenue) as revenue'),
                DB::raw('SUM(impressions) as impressions'),
                DB::raw('(SUM(revenue) * 1000 / SUM(impressions)) as cpm')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        $totalRevenue = $reports->sum('revenue');
        $totalImpressions = $reports->sum('impressions');
        $totalCpm = ($totalRevenue * 1000) / $totalImpressions;

        $data = $reports->keyBy('date')->toArray();
        $data['total'] = [
            'sum' => $totalRevenue,
            'impressions' => $totalImpressions,
            'cpm' => $totalCpm
        ];

        return response()->json(['data' => $data]);
    }
}
