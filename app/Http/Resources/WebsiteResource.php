<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class WebsiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     // return [
    //     //     'id' => $this->id,
    //     //     'url' => $this->url,
    //     //     'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
    //     // ];

    //     return [
    //         'data' => $this->collection,
    //         'pagination' => [
    //             'lastPage' => $this->lastPage(),
    //             'currentPage' => $this->currentPage(),
    //             'perPage' => $this->perPage(),
    //             'total' => $this->total(),
    //             ],
    //     ];
    // }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'per_page' => $this->perPage(),
                'total' => $this->total(),
                'from' => $this->firstItem(),
                'to' => $this->lastItem(),
            ],
            
        ];
    }
}
