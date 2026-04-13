<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasTranslations, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name_father',
        'user_id',
        'national_id_father',
        'passport_id_father',
        'phone_father',
        'job_father',
        'nationality_father_id',
        'blood_type_father_id',
        'religion_father_id',
        'address_father',

        'name_mother',
        'national_id_mother',
        'passport_id_mother',
        'phone_mother',
        'job_mother',
        'nationality_mother_id',
        'blood_type_mother_id',
        'religion_mother_id',
        'address_mother',
    ];

    public $translatable = [
        'name_father',
        'job_father',
        'name_mother',
        'job_mother',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
             ->logOnly([
                'phone_father',
                'phone_mother',
                'nationality_father_id',
                'nationality_mother_id',
                'blood_type_father_id',
                'blood_type_mother_id',
                'religion_father_id',
                'religion_mother_id',
                'address_father',
                'address_mother',
            ])
             ->logOnlyDirty()
             ->dontSubmitEmptyLogs();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Student::class, 'parent_id');
    }
}
