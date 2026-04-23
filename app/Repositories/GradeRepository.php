<?php

namespace App\Repositories;

use App\DTOs\GradeDTO;
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

    public function create(GradeDTO $dto): Grade
    {
        return Grade::create([
            "name" => [
                "ar" => $dto->nameAr,
                "en" => $dto->nameEn,
            ],
            "notes" => $dto->notes,
        ]);
    }

    public function update(Grade $grade, GradeDTO $dto): Grade
    {
        $grade->update([
            "name" => [
                "ar" => $dto->nameAr,
                "en" => $dto->nameEn,
            ],
            "notes" => $dto->notes,
        ]);

        return $grade;
    }

    public function delete(Grade $grade): void
    {
        $grade->delete();
    }
}
