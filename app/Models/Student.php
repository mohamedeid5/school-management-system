<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\HasAttachments;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Student extends Model
{
    use SoftDeletes, LogsActivity, HasAttachments;

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
        'nationality_id',
        'blood_type_id',
        'academic_year'
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
                'student_code',
                'nationality_id',
                'blood_type_id',
                'academic_year'
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
        return $this->belongsTo(User::class)->withTrashed();
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

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);

    }

    public function feeInvoices()
    {
        return $this->hasMany(FeeInvoice::class);
    }

    public function studentAccounts()
    {
        return $this->hasMany(StudentAccount::class);
    }

    public function currentBalance(): Attribute
    {
        return Attribute::get(function() {
            return $this->studentAccounts->sum('debit') - $this->studentAccounts->sum('credit');
        });
    }

}
