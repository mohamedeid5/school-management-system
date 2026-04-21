<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'specialization' => $this->specialization,
            'gender' => $this->gender,
            'joining_date' => $this->joining_date,
            'address' => $this->address,
            'user' => $this->whenLoaded('user'),
            'specialization' => $this->whenLoaded('specialization'),
            'sections' => SectionResource::collection($this->whenLoaded('sections')),
        ];
    }
}
