<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'national_id_father' => 'required|string|max:255',
            'passport_id_father' => 'required|string|max:255',
            'phone_father' => 'required|string|max:255',
            'job_father' => 'required|string|max:255',
            'job_father_en' => 'required|string|max:255',
            'nationality_father_id' => 'required|integer|exists:nationalities,id',
            'blood_type_father_id' => 'required|integer|exists:blood_types,id',
            'religion_father_id' => 'required|integer|exists:religions,id',
            'address_father' => 'required|string|max:255',
            'name_mother' => 'required|string|max:255',
            'name_mother_en' => 'required|string|max:255',
            'national_id_mother' => 'required|string|max:255',
            'passport_id_mother' => 'required|string|max:255',
            'phone_mother' => 'required|string|max:255',
            'job_mother' => 'required|string|max:255',
            'job_mother_en' => 'required|string|max:255',
            'nationality_mother_id' => 'required|integer|exists:nationalities,id',
            'blood_type_mother_id' => 'required|integer|exists:blood_types,id',
            'religion_mother_id' => 'required|integer|exists:religions,id',
            'address_mother' => 'required|string|max:255',
        ];
    }
}
