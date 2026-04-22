<?php

namespace App\Http\Requests;

use App\Enums\AttendanceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AttendanceApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'grade_id'                    => 'required|exists:grades,id',
            'classroom_id'                => 'required|exists:classrooms,id',
            'section_id'                  => 'required|exists:sections,id',
            'attendance_date'             => 'required|date',
            'attendances'                 => 'required|array|min:1',
            'attendances.*.student_id'    => 'required|exists:students,id',
            'attendances.*.status'        => ['required', new Enum(AttendanceStatus::class)],
            'attendances.*.description'   => 'nullable|string|max:255',
        ];
    }
}
