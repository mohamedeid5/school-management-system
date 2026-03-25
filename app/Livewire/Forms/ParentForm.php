<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ParentForm extends Form
{
    #[Validate('required|email|max:255|unique:my_parents,email')]
    public $email = '';

    #[Validate('required|string|min:8')]
    public $password = '';

    #[Validate('required|string|max:255')]
    public $name_father = '';

    #[Validate('required|string|max:255')]
    public $name_father_en = '';

    #[Validate('required|digits:14')]
    public $national_id_father = '';

    #[Validate('nullable|string|max:50')]
    public $passport_id_father = '';

    #[Validate('required|regex:/^01[0125][0-9]{8}$/')]
    public $phone_father = '';

    #[Validate('required|string|max:255')]
    public $job_father = '';

    #[Validate('required|string|max:255')]
    public $job_father_en = '';

    #[Validate('required|exists:nationalities,id')]
    public $nationality_father_id = '';

    #[Validate('required|exists:blood_types,id')]
    public $blood_type_father_id = '';

    #[Validate('required|exists:religions,id')]
    public $religion_father_id = '';

    #[Validate('required|string|max:1000')]
    public $address_father = '';

    #[Validate('required|string|max:255')]
    public $name_mother = '';

    #[Validate('required|string|max:255')]
    public $name_mother_en = '';

    #[Validate('required|digits:14')]
    public $national_id_mother = '';

    #[Validate('nullable|string|max:50')]
    public $passport_id_mother = '';

    #[Validate('required|regex:/^01[0125][0-9]{8}$/')]
    public $phone_mother = '';

    #[Validate('required|string|max:255')]
    public $job_mother = '';

    #[Validate('required|string|max:255')]
    public $job_mother_en = '';

    #[Validate('required|exists:nationalities,id')]
    public $nationality_mother_id = '';

    #[Validate('required|exists:blood_types,id')]
    public $blood_type_mother_id = '';

    #[Validate('required|exists:religions,id')]
    public $religion_mother_id = '';

    #[Validate('required|string|max:1000')]
    public $address_mother = '';

    #[Validate(['photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'])]
    public $photos = [];

    public function validationAttributes(): array
    {
        return [
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'name_father' => 'اسم الأب بالعربي',
            'name_father_en' => 'اسم الأب بالإنجليزي',
            'national_id_father' => 'رقم هوية الأب',
            'passport_id_father' => 'رقم جواز سفر الأب',
            'phone_father' => 'هاتف الأب',
            'job_father' => 'وظيفة الأب بالعربي',
            'job_father_en' => 'وظيفة الأب بالإنجليزي',
            'nationality_father_id' => 'جنسية الأب',
            'blood_type_father_id' => 'فصيلة دم الأب',
            'religion_father_id' => 'ديانة الأب',
            'address_father' => 'عنوان الأب',

            'name_mother' => 'اسم الأم بالعربي',
            'name_mother_en' => 'اسم الأم بالإنجليزي',
            'national_id_mother' => 'رقم هوية الأم',
            'passport_id_mother' => 'رقم جواز سفر الأم',
            'phone_mother' => 'هاتف الأم',
            'job_mother' => 'وظيفة الأم بالعربي',
            'job_mother_en' => 'وظيفة الأم بالإنجليزي',
            'nationality_mother_id' => 'جنسية الأم',
            'blood_type_mother_id' => 'فصيلة دم الأم',
            'religion_mother_id' => 'ديانة الأم',
            'address_mother' => 'عنوان الأم',
        ];
    }

    public function fatherRules(): array
    {
        return [
            'email' => 'required|email|max:255|unique:my_parents,email',
            'password' => 'required|string|min:8',
            'name_father' => 'required|string|max:255',
            'name_father_en' => 'required|string|max:255',
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
            'photos.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
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
