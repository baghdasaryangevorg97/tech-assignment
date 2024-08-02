<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResourceByWebsite extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this->resource; 
        return [
            'date' => $data['date'],
            'revenue' => $data['revenue'],
            'impressions' => $data['impressions'],
            'cpm' => $data['cpm'],
        ];
    }
}
