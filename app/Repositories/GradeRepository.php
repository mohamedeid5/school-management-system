<?php

namespace App\Repositories;

use App\Models\Grade;

class GradeRepository
{
    public function getAll()
    {
        return Grade::all();
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
