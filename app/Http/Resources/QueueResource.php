<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QueueResource extends JsonResource
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
            'code' => $this->code,
            'remark' => $this->remark,
            'status' => $this->status,
            'reservationDate' => $this->reservation_date,
            'confirmedAt' => $this->confirmed_at,
            'servedAt' => $this->served_at,
            'customer' => new CustomerResource($this->whenLoaded('customer'))
        ];
    }
}
