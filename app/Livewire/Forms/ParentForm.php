<?php

namespace App\Livewire\Forms;

use Illuminate\Validation\Rule;
use Livewire\Form;

class ParentForm extends Form
{
    public ?int $id = null;

    public string $email = '';
    public string $password = '';

    public string $name_father = '';
    public string $national_id_father = '';
    public string $passport_id_father = '';
    public string $phone_father = '';
    public string $job_father = '';
    public string $job_father_en = '';
    public string $nationality_father_id = '';
    public string $blood_type_father_id = '';
    public string $religion_father_id = '';
    public string $address_father = '';

    public string $name_mother = '';
    public string $name_mother_en = '';
    public string $national_id_mother = '';
    public string $passport_id_mother = '';
    public string $phone_mother = '';
    public string $job_mother = '';
    public string $job_mother_en = '';
    public string $nationality_mother_id = '';
    public string $blood_type_mother_id = '';
    public string $religion_mother_id = '';
    public string $address_mother = '';

    public array $photos = [];

    public function rules(): array
    {
        return $this->allRules();
    }

    public function validationAttributes(): array
    {
        return [
            'email' => __('main.email'),
            'password' => __('main.password'),

            'name_father' => __('main.name_father_ar'),
            'national_id_father' => __('main.national_id_father'),
            'passport_id_father' => __('main.passport_id_father'),
            'phone_father' => __('main.phone_father'),
            'job_father' => __('main.job_father_ar'),
            'job_father_en' => __('main.job_father_en'),
            'nationality_father_id' => __('main.nationality_father'),
            'blood_type_father_id' => __('main.blood_type_father'),
            'religion_father_id' => __('main.religion_father'),
            'address_father' => __('main.address_father'),

            'name_mother' => __('main.name_mother_ar'),
            'name_mother_en' => __('main.name_mother_en'),
            'national_id_mother' => __('main.national_id_mother'),
            'passport_id_mother' => __('main.passport_id_mother'),
            'phone_mother' => __('main.phone_mother'),
            'job_mother' => __('main.job_mother_ar'),
            'job_mother_en' => __('main.job_mother_en'),
            'nationality_mother_id' => __('main.nationality_mother'),
            'blood_type_mother_id' => __('main.blood_type_mother'),
            'religion_mother_id' => __('main.religion_mother'),
            'address_mother' => __('main.address_mother'),

            'photos.*' => __('main.photos'),
        ];
    }

    public function fatherRules(): array
    {
        $userId = null;

        if($this->id) {
            $userId = \App\Models\MyParent::find($this->id)->user_id;
        }
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($userId),
            ],
            'password' => $this->id ? 'nullable|string|min:8' : 'required|string|min:8',
            'name_father' => 'required|string|max:255',
            'national_id_father' => 'required|digits:14',
            'passport_id_father' => 'nullable|string|max:50',
            'phone_father' => 'required|regex:/^01[0125][0-9]{8}$/',
            'job_father' => 'required|string|max:255',
            'job_father_en' => 'required|string|max:255',
            'nationality_father_id' => 'required|exists:nationalities,id',
            'blood_type_father_id' => 'required|exists:blood_types,id',
            'religion_father_id' => 'required|exists:religions,id',
            'address_father' => 'required|string|max:1000',
        ];
    }

    public function motherRules(): array
    {
        return [
            'name_mother' => 'required|string|max:255',
            'name_mother_en' => 'required|string|max:255',
            'national_id_mother' => 'required|digits:14',
            'passport_id_mother' => 'nullable|string|max:50',
            'phone_mother' => 'required|regex:/^01[0125][0-9]{8}$/',
            'job_mother' => 'required|string|max:255',
            'job_mother_en' => 'required|string|max:255',
            'nationality_mother_id' => 'required|exists:nationalities,id',
            'blood_type_mother_id' => 'required|exists:blood_types,id',
            'religion_mother_id' => 'required|exists:religions,id',
            'address_mother' => 'required|string|max:1000',
        ];
    }

    public function attachmentRules(): array
    {
        return [
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function allRules(): array
    {
        return array_merge(
            $this->fatherRules(),
            $this->motherRules(),
            $this->attachmentRules(),
        );
    }
}
