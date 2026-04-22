<?php

namespace App\Actions\Parents;

use App\Models\MyParent;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Events\ParentCreated;
use App\Models\User;

class CreateParentAction
{
    public function handle($form): MyParent
    {
        return DB::transaction(function () use ($form) {

            $user = User::create([
                'name' => $form->name_father,
                'email' => $form->email,
                'password' => Hash::make($form->password)
            ]);

            $user->assignRole('parent');

            $parent = MyParent::create($this->parentData($form, $user->id));

            $this->storeAttachments($parent, $form);

            event(new ParentCreated($parent));

            return $parent;
        });

    }

    protected function parentData($form, $userId): array
    {
        return [
            'national_id_father' => $form->national_id_father,
            'passport_id_father' => $form->passport_id_father,
            'phone_father' => $form->phone_father,
            'job_father' => [
                'ar' => $form->job_father,
                'en' => $form->job_father_en,
            ],
            'nationality_father_id' => $form->nationality_father_id,
            'blood_type_father_id' => $form->blood_type_father_id,
            'religion_father_id' => $form->religion_father_id,
            'address_father' => $form->address_father,

            'name_mother' => [
                'ar' => $form->name_mother,
                'en' => $form->name_mother_en,
            ],
            'national_id_mother' => $form->national_id_mother,
            'passport_id_mother' => $form->passport_id_mother,
            'phone_mother' => $form->phone_mother,
            'job_mother' => [
                'ar' => $form->job_mother,
                'en' => $form->job_mother_en,
            ],
            'nationality_mother_id' => $form->nationality_mother_id,
            'blood_type_mother_id' => $form->blood_type_mother_id,
            'religion_mother_id' => $form->religion_mother_id,
            'address_mother' => $form->address_mother,
            'user_id' => $userId

        ];
    }

    protected function storeAttachments($parent, $form): void
    {
        if (empty($form->photos)) {
            return;
        }

        foreach ($form->photos as $photo) {
            $name = $photo->hashName();
            $photo->storeAs($parent->id, $name, 'parent_attachments');

            ParentAttachment::create([
                'file_name' => $name,
                'parent_id' => $parent->id
            ]);
        }
    }
}
