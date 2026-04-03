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
        'description'
    ];

    public array $translatable = ['name'];

     public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
             ->logOnly(['name'])
             ->logOnlyDirty()
             ->dontSubmitEmptyLogs();
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
