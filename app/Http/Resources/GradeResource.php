<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClassroomResource;

class GradeResource extends JsonResource
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
            'name'       => [
                'ar' => $this->getTranslation('name', 'ar'),
                'en' => $this->getTranslation('name', 'en'),
            ],
            'notes' => $this->notes,
            'classrooms_count' => $this->whenCounted('classrooms'),
            'classrooms' => ClassroomResource::collection($this->whenLoaded('classrooms')),
            'sections' => SectionResource::collection($this->whenLoaded('sections')),
        ];
    }
}
