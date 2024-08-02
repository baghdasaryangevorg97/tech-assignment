<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportWebsiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => ReportResourceByWebsite::collection($this->resource['data']),
        ];
    }

    public function with($request)
    {
        $totalData = $this->resource['total'];
        return [
            'total' => [
                'sum' => $totalData['sum'],
                'impressions' => $totalData['impressions'],
                'cpm' => $totalData['cpm']
            ],
            
        ];
    }
}
