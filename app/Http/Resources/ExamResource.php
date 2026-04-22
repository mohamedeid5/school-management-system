<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name'          => $this->getTranslations('name'),
            'type'          => $this->type->label(),
            'academic_year' => $this->academic_year,
            'term'          => $this->term,
            'exam_date'     => $this->exam_date,
            'max_score'     => $this->max_score,
            'subject_id'    => $this->subject_id,
            'grade_id'      => $this->grade_id,
            'classroom_id'  => $this->classroom_id,
            'teacher_id'    => $this->teacher_id,
            'subject'       => new SubjectResource($this->whenLoaded('subject')),
            'grade'         => new GradeResource($this->whenLoaded('grade')),
            'classroom'     => new ClassroomResource($this->whenLoaded('classroom')),
            'teacher'       => $this->whenLoaded('teacher'),
        ];
    }
}
