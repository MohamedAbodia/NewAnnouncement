<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'report_id' => $this->report_id,
            'user_id' => $this->user_id,
            // 'month_name' => $this->created_at->format('M'),
            // 'year_number' => $this->created_at->format('y')
        ];
    }
}
