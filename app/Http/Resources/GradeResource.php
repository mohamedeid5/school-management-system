<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            //'classrooms' => ClasssroomResource($this->whenLoaded('classrooms'))
            'classrooms' => $this->whenLoaded('classrooms'),
        ];
    }
}
