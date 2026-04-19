<?php

namespace App\Repositories;

use App\Models\Grade;
use Illuminate\Support\Facades\Cache;

class GradeRepository
{
    public function getAll($user)
    {

        $gradeCacheKey = 'grades_user_' . $user->id;

        return Cache::tags(['grades'])->rememberForever($gradeCacheKey, function() use ($user) {
            return Grade::with('classrooms')
                ->withCount('classrooms')
                ->authorizedForUser($user)
                ->get();
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
}
