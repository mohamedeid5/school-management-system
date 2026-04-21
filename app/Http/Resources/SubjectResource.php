<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => [
                "en" => $this->getTranslation('name', 'ar'),
                "ar" => $this->getTranslation('name', 'en'),
            ],
            "code" => $this->code,
            "grade_id" => $this->grade_id,
            "classroom_id" => $this->classroom_id,
            "teacher_id" => $this->teacher_id,
            "grade" => new GradeResource($this->whenLoaded('grade')),
            "classroom" => new ClassroomResource($this->whenLoaded('classroom')),
            //"teacher" => new TeacherResource($this->whenLoaded('teacher')),
        ];
    }
}
