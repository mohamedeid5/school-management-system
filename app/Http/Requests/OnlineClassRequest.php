<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnlineClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title.ar'     => 'required|string|max:255',
            'title.en'     => 'required|string|max:255',
            'type'         => 'required|in:zoom,manual',
            'grade_id'     => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id'   => 'nullable|exists:subjects,id',
            'start_at'     => 'required|date',
            'duration'     => 'required|integer|min:15|max:480',
            'join_url'     => 'required_if:type,manual|nullable|url|max:2000',
            'description'  => 'nullable|string|max:2000',
        ];
    }
}
