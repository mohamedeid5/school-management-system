<?php

namespace App\Repositories;

use App\Models\Grade;
use Illuminate\Support\Facades\Cache;

class GradeRepository
{
    public function getAll()
    {
        $grades = Cache::rememberForever('all_grades', function() {
            return Grade::all();
        });

        return $grades;
    }

    public function create(array $data): Grade
    {
        return Grade::create($data);
    }

    public function update(Grade $grade, array $data): Grade
    {
        $grade->update($data);

        return $grade;
    }

    public function delete(Grade $grade): void
    {
        $grade->delete();
    }

    public function hasClassrooms(Grade $grade): bool
    {
        return $grade->classrooms()->exists();
    }
}
