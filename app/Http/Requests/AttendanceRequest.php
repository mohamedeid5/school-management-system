<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\AttendanceStatus;

class AttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attendance_status' => 'required|array',
            'attendance_status.*' => ['required', new Enum(AttendanceStatus::class)],
            'student_ids' => 'required|array',
            'student_ids.*' => 'required|exists:students,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'attendance_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ];
    }
}
