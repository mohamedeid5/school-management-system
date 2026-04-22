<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'student_id'        => $this->student_id,
            'grade_id'          => $this->grade_id,
            'classroom_id'      => $this->classroom_id,
            'section_id'        => $this->section_id,
            'attendance_date'   => $this->attendance_date,
            'attendance_status' => $this->attendance_status->value,
            'description'       => $this->description,
            'student'           => $this->whenLoaded('student'),
        ];
    }
}
