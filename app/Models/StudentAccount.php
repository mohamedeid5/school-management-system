<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StudentAccount extends Model
{
    use LogsActivity;

    protected $fillable = [
        'date',
        'type',
        'student_id',
        'fee_invoice_id',
        'debit',
        'credit',
        'description',
        'receipt_student_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('student_account')
            ->logOnly(['date', 'type', 'student_id', 'fee_invoice_id', 'debit', 'credit', 'description'])
            ->setDescriptionForEvent(fn(string $eventName) => "Student Account entry has been {$eventName}");
    }

    protected $casts = [
        'type' => \App\Enums\AccountType::class,
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
