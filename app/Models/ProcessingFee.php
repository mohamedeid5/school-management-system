<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ProcessingFee extends Model
{
    use LogsActivity;

    protected $fillable = [
        'date',
        'student_id',
        'amount',
        'description'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('processing_fee')
            ->logOnly(['date', 'student_id', 'amount', 'description'])
            ->setDescriptionForEvent(fn(string $eventName) => "Processing Fee has been {$eventName}");
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
