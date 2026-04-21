<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => [
                'ar' => $this->getTranslation('name', 'ar'),
                'en' => $this->getTranslation('name', 'en'),
            ],
            'status' => $this->status,
            'grade_id' => $this->grade_id,
            'classroom_id' => $this->classroom_id,
            'grade' => new GradeResource($this->whenLoaded('grade')),
            'classroom' => new ClassroomResource($this->whenLoaded('classroom')),
        ];
    }
}
