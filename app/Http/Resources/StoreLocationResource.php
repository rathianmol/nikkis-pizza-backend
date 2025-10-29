<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreLocationResource extends JsonResource
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
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'monday_hours' => $this->monday_hours,
            'tuesday_hours' => $this->tuesday_hours,
            'wednesday_hours' => $this->wednesday_hours,
            'thursday_hours' => $this->thursday_hours,
            'friday_hours' => $this->friday_hours,
            'saturday_hours' => $this->saturday_hours,
            'sunday_hours' => $this->sunday_hours,
            'is_active' => $this->is_active,
            'is_primary' => $this->is_primary,
        ];
    }
}