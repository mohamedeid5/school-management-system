<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'student_code' => $this->student_code,
            'date_of_birth' => $this->date_of_birth,
            'joining_date' => $this->joining_date,
            'gender' => $this->gender,
            'parent_id' => $this->parent_id,
            'user_id' => $this->user_id,
            'grade_id' => $this->grade_id,
            'classroom_id' => $this->classroom_id,
            'section_id' => $this->section_id,
            'nationality_id' => $this->nationality_id,
            'blood_type_id' => $this->blood_type_id,
            'academic_year' => $this->academic_year,
            'user' => $this->whenLoaded('user'),
            'grade' => new GradeResource($this->whenLoaded('grade')),
            'classroom' => new ClassroomResource($this->whenLoaded('classroom')),
            'section' => new SectionResource($this->whenLoaded('section')),
            'parent' => $this->whenLoaded('parent'),
            'nationality' => $this->whenLoaded('nationality'),
            'blood_type' => $this->whenLoaded('bloodType'),
        ];
    }
}
