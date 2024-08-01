<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::paginate(20);
        return view('content.website.index', compact('websites'));
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        Website::create($request->all());
        return redirect()->route('links.index');
    }

    public function show(Website $website)
    {
        return view('content..show', compact('link'));
    }

    public function showReport($id)
    {
        $reports = DB::table('website_reports')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(revenue) as revenue'),
                DB::raw('SUM(impressions) as impressions'),
                DB::raw('(SUM(revenue) * 1000 / SUM(impressions)) as cpm')
            )
            ->where('website_id', $id)
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

    // public function websites(Website $website)
    // {
    //     return view('links.show', compact('link'));
    // }

    public function edit(Website $website)
    {
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, Website $website)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $website->update($request->all());
        return redirect()->route('links.index');
    }

    public function destroy(Website $website)
    {
        $website->delete();
        return redirect()->route('links.index');
    }

}
