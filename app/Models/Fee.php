<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Fee extends Model
{
    use HasTranslations, LogsActivity;

    protected $fillable = [
        'name',
        'amount',
        'grade_id',
        'classroom_id',
        'academic_year',
        'fee_type',
        'description',
    ];

    public array $translatable = ['name'];

    protected $casts = [
        'fee_type' => \App\Enums\FeeType::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('fee')
            ->logOnly(['name', 'amount', 'grade_id', 'classroom_id', 'academic_year', 'fee_type', 'description'])
            ->setDescriptionForEvent(fn(string $eventName) => "Fee has been {$eventName}");
    }

     public function feeInvoices()
    {
        return $this->hasMany(FeeInvoice::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Grade::class);
    }
}
