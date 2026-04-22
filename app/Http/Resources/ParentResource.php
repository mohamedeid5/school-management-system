<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user'),
            'national_id_father' => $this->national_id_father,
            'passport_id_father' => $this->passport_id_father,
            'phone_father' => $this->phone_father,
            'job_father' => $this->getTranslation('job_father', app()->getLocale()),
            'nationality_father_id' => $this->nationality_father_id,
            'blood_type_father_id' => $this->blood_type_father_id,
            'religion_father_id' => $this->religion_father_id,
            'address_father' => $this->address_father,
            'name_mother' => $this->getTranslation('name_mother', app()->getLocale()),
            'job_mother' => $this->getTranslation('job_mother', app()->getLocale()),
            'national_id_mother' => $this->national_id_mother,
            'passport_id_mother' => $this->passport_id_mother,
            'phone_mother' => $this->phone_mother,
            'job_mother' => $this->getTranslation('job_mother', app()->getLocale()),
            'nationality_mother_id' => $this->nationality_mother_id,
            'blood_type_mother_id' => $this->blood_type_mother_id,
            'religion_mother_id' => $this->religion_mother_id,
            'address_mother' => $this->address_mother,
        ];
    }
}
