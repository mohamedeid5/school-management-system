<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Gender;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
class Teacher extends Model
{

    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'user_id',
        'specialization_id',
        'gender',
        'joining_date',
        'address'
    ];

    protected $casts = [
        'gender' => Gender::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
             ->logOnly(['name', 'user_id', 'specialization_id', 'gender', 'joining_date', 'address'])
             ->logOnlyDirty()
             ->dontSubmitEmptyLogs();
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::class, Exam::class);
    }
}
