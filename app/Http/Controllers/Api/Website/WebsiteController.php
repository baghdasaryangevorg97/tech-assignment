<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWebsiteRequest;
use App\Models\Report;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::paginate(20);

        return response()->json($websites);
    }

    public function store(CreateWebsiteRequest $request)
    {
        Website::create($request->all());
        return response()->json(['success' => true]);
    }

    public function show(Website $website)
    {
        return view('content..show', compact('link'));
    }

    // public function showReport(int $id)
    // {
    //     $reports = Report::where('website_id', $id)->select('created_at', 'revenue', 'impressions', 'date')->get();
    //     $data = $reports->keyBy('date');
        
    //     dd($data);
    //     // $reports = DB::table('reports')
    //     //     ->select(
    //     //         DB::raw('DATE(created_at) as date'),
    //     //         DB::raw('SUM(revenue) as revenue'),
    //     //         DB::raw('SUM(impressions) as impressions'),
    //     //         DB::raw('(SUM(revenue) * 1000 / SUM(impressions)) as cpm')
    //     //     )
    //     //     ->where('website_id', $id)
    //     //     ->groupBy(DB::raw('DATE(created_at)'))
    //     //     ->get();

    //     $totalRevenue = $reports->sum('revenue');
    //     $totalImpressions = $reports->sum('impressions');
    //     $totalCpm = ($totalRevenue * 1000) / $totalImpressions;

    //     $data = $reports->keyBy('date')->toArray();
    //     $data['total'] = [
    //         'sum' => $totalRevenue,
    //         'impressions' => $totalImpressions,
    //         'cpm' => $totalCpm
    //     ];
    //     dd($data, $id);
    //     return response()->json(['data' => $data]);
    // }

    public function showReport(int $id)
    {
        $reports = Report::where('website_id', $id)->
        select([
            'date',
            'revenue',
            'impressions',
            DB::raw('(revenue * 1000 / NULLIF(impressions, 0)) as cpm')
        ])
        ->get();

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
        
        return response()->json(['data' => $data, 'total' => $total]);
    }

    // public function websites(Website $website)
    // {
    //     return view('links.show', compact('link'));
    // }

    public function edit($id, Request $request)
    {
        Website::where('id', $id)->update(['url' => $request->url]);
        return response()->json(['success' => true]);
    }

    public function update(Request $request, Website $website)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $website->update($request->all());
        return redirect()->route('links.index');
    }

    public function destroy($id)
    {
        $website = Website::find($id);

        if ($website->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

}
