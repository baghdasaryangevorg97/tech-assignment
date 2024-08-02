<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "website_id" => $this->website_id,
            "revenue" => $this->revenue,
            "impressions" => $this->impressions,
            "clicks" => $this->clicks,
            "date" => $this->date,
        ];
    }
}
