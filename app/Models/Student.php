<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Student extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = [
        'student_code',
        'date_of_birth',
        'joining_date',
        'gender',
        'parent_id',
        'user_id',
        'grade_id',
        'classroom_id',
        'section_id',
    ];

    protected $casts = [
        'gender' => Gender::class,
        'date_of_birth' => 'date',
        'joining_date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
             ->logOnly([
                'grade_id',
                'classroom_id',
                'section_id',
                'parent_id',
                'user_id',
                'date_of_birth',
                'joining_date',
                'gender',
                'student_code'
            ])
             ->logOnlyDirty()
             ->dontSubmitEmptyLogs();
    }

    public function parent()
    {
        return $this->belongsTo(MyParent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
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
