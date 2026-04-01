<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'student_id',
        'from_grade_id',
        'from_classroom_id',
        'from_section_id',
        'to_grade_id',
        'to_classroom_id',
        'to_section_id',
        'academic_year',
        'academic_year_new',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fromGrade()
    {
        return $this->belongsTo(Grade::class, 'from_grade_id');
    }

    public function fromClassroom()
    {
        return $this->belongsTo(Classroom::class, 'from_classroom_id');
    }

    public function fromSection()
    {
        return $this->belongsTo(Section::class, 'from_section_id');
    }

    public function toGrade()
    {
        return $this->belongsTo(Grade::class, 'to_grade_id');
    }

    public function toClassroom()
    {
        return $this->belongsTo(Classroom::class, 'to_classroom_id');
    }

    public function toSection()
    {
        return $this->belongsTo(Section::class, 'to_section_id');
    }


}
