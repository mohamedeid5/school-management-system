<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Enums\AttendanceStatus;

class Attendance extends Model
{
    use LogsActivity;

    protected $fillable = [
        'student_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'attendance_date',
        'attendance_status',
        'description'
    ];

    protected $casts = [
        'attendance_status' => AttendanceStatus::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('attendance')
            ->logOnly(['student_id', 'classroom_id', 'section_id', 'attendance_date', 'attendance_status', 'description'])
            ->setDescriptionForEvent(fn(string $eventName) => "Attendance has been {$eventName}");
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
