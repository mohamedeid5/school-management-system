<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class FeeInvoice extends Model
{
    use LogsActivity;

    protected $fillable = [
        'invoice_date',
        'student_id',
        'fee_id',
        'amount',
        'description'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('fee_invoice')
            ->logOnly(['invoice_date', 'student_id', 'fee_id', 'amount', 'description'])
            ->setDescriptionForEvent(fn(string $eventName) => "Fee Invoice has been {$eventName}");
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
}
