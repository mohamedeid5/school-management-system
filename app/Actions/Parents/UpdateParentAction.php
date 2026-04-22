<?php

namespace App\Actions\Parents;

use App\Models\ParentAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateParentAction
{
    public function handle($parent, $form)
    {
        return DB::transaction(function () use ($parent, $form) {

           $user = User::findOrFail($parent->user_id);

            $user->name = $form->name_father;
            $user->email = $form->email;

            if (!empty($form->password)) {
                $user->password = Hash::make($form->password);
            }
            $user->update();

            $parent->update([
                'job_father' => ['en' => $form->job_father_en, 'ar' => $form->job_father],

                'national_id_father' => $form->national_id_father,
                'passport_id_father' => $form->passport_id_father,
                'phone_father' => $form->phone_father,
                'nationality_father_id' => $form->nationality_father_id,
                'blood_type_father_id' => $form->blood_type_father_id,
                'religion_father_id' => $form->religion_father_id,
                'address_father' => $form->address_father,

                'name_mother' => ['en' => $form->name_mother_en, 'ar' => $form->name_mother],
                'job_mother' => ['en' => $form->job_mother_en, 'ar' => $form->job_mother],

                'national_id_mother' => $form->national_id_mother,
                'passport_id_mother' => $form->passport_id_mother,
                'phone_mother' => $form->phone_mother,
                'nationality_mother_id' => $form->nationality_mother_id,
                'blood_type_mother_id' => $form->blood_type_mother_id,
                'religion_mother_id' => $form->religion_mother_id,
                'address_mother' => $form->address_mother,
            ]);


            $this->storeAttachments($parent, $form);

            return $parent;
        });
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
