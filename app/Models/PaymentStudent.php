<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PaymentStudent extends Model
{
    use LogsActivity;

    protected $fillable = [
        'date',
        'student_id',
        'amount',
        'description',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('payment_student')
            ->logOnly(['date', 'student_id', 'amount', 'description'])
            ->setDescriptionForEvent(fn (string $eventName) => "Payment Student has been {$eventName}");
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
