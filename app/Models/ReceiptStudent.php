<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ReceiptStudent extends Model
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
             ->logOnly(['amount', 'description'])
             ->logOnlyDirty()
             ->dontSubmitEmptyLogs();
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
