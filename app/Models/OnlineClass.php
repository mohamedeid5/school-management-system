<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class OnlineClass extends Model
{
    use LogsActivity, HasTranslations;

    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'type',
        'subject_id',
        'grade_id',
        'classroom_id',
        'user_id',
        'start_at',
        'duration',
        'status',
        'zoom_meeting_id',
        'join_url',
        'start_url',
        'description',
    ];

    protected $casts = [
        'start_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('online_class')
            ->logOnly(['title', 'subject_id', 'grade_id', 'classroom_id', 'user_id', 'start_at', 'duration', 'status'])
            ->setDescriptionForEvent(fn (string $eventName) => "Online Class has been {$eventName}");
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
