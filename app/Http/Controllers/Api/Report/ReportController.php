<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReportRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function index()
    {
        $data = $this->reportService->index();

        return  response()->json($data);
    }

    public function getAll()
    {
        $reports = Report::all();

        return  ReportResource::collection($reports);
    }


    public function store(AddReportRequest $request)
    {
        $date = $request->date;
        $website_id = $request->website_id;

        if(!Report::where('date', $date)->where('website_id', $website_id)->exists()) {
            $report = Report::create($request->all());
    
            return new ReportResource($report);
        } 

        return response()->json(['message' => 'Report already exists'], 409);
    }

   

    // public function show(Request $request)
    // {
    //     $reports = DB::table('reports')
    //         ->select(
    //             DB::raw('DATE(created_at) as date'),
    //             DB::raw('SUM(revenue) as revenue'),
    //             DB::raw('SUM(impressions) as impressions'),
    //             DB::raw('(SUM(revenue) * 1000 / SUM(impressions)) as cpm')
    //         )
    //         ->groupBy(DB::raw('DATE(created_at)'))
    //         ->get();

    //     $totalRevenue = $reports->sum('revenue');
    //     $totalImpressions = $reports->sum('impressions');
    //     $totalCpm = ($totalRevenue * 1000) / $totalImpressions;

    //     $data = $reports->keyBy('date')->toArray();
    //     $data['total'] = [
    //         'sum' => $totalRevenue,
    //         'impressions' => $totalImpressions,
    //         'cpm' => $totalCpm
    //     ];

    //     return response()->json(['data' => $data]);
    // }
}
