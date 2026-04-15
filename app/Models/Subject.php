<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use LogsActivity, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'code',
        'grade_id',
        'classroom_id',
        'teacher_id',
        'description',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('subject')
            ->logOnly(['name', 'code', 'teacher_id', 'grade_id', 'classroom_id', 'description'])
            ->setDescriptionForEvent(fn (string $eventName) => "Subject has been {$eventName}");
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function scopeAuthorizedForUser($query, $user) {

         $query->with(['grade', 'classroom', 'teacher']);

        if($user->hasRole('teacher')) {
            return $query->where('teacher_id', $user->teacher->id);
        }

        if ($user->hasRole('student')) {
            return $query->where('grade_id', $user->student->grade_id)
                  ->where('classroom_id', $user->student->classroom_id);
        }

        return $query;
    }

}



