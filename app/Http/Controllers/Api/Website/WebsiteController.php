<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWebsiteRequest;
use App\Http\Resources\ReportWebsiteResource;
use App\Http\Resources\WebsiteResource;
use App\Models\Report;
use App\Models\Website;
use App\Services\WebsiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WebsiteController extends Controller
{

    protected $websiteService;

    public function __construct(WebsiteService $websiteService)
    {
        $this->websiteService = $websiteService;
    }

    public function index()
    {
        $websites = $this->websiteService->index();

        return WebsiteResource::collection($websites);
        
    }

    public function store(CreateWebsiteRequest $request)
    {
        $created = $this->websiteService->create($request->all());

        if($created){
            return response()->json(['success' => true], 201);
        }

        return response()->json(['success' => false], 500);
    }

    public function showReport(int $id)
    {
        $reports = $this->websiteService->showReport($id);
        
        return new ReportWebsiteResource($reports);
    }

    public function edit($id, Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $data = $this->websiteService->edit($id, $request->url);

        if($data){
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 500);
    }

    public function destroy($id)
    {
        $delete = $this->websiteService->destroy($id);

        if ($delete) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 500);
    }

}
