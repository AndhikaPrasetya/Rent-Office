<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewBookingResource extends JsonResource
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
            'name' => $this->name,
            'booking_trx_id' => $this->booking_trx_id,
            'is_paid' => $this->is_paid,
            'phone_number' => $this->phone_number,
            'duration' => $this->duration,
            'total_amount' => $this->total_amount,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
            'office' => new OfficeSpaceResource($this->whenLoaded('officeSpace'))
        ];
    }
}
