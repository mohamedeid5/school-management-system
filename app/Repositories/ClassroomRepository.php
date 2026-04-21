<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ClassroomRepository
{
    public function getIndexData(array $filters = []): array
    {

        $grades = Cache::rememberForever('all_grades', function () {
            return Grade::all();
        });

        $allClassrooms = Cache::rememberForever('all_classrooms', function() {
            return Classroom::with(['grade', 'sections'])->withCount('sections')->latest()->get();
        });

        $classrooms = $allClassrooms->when($filters['grade_id'] ?? '', function($query) use ($filters) {
            return $query->where('grade_id', $filters['grade_id']);
        });

        return [
            'grades'     => $grades,
            'classrooms' => $classrooms->values(),
        ];
    }

    public function create(array $request): array
    {
        return DB::transaction(function () use ($request) {
            $created = [];
            foreach ($request['list_classrooms'] as $classroomData) {
                $created[] = Classroom::create([
                    'name' => [
                        'ar' => $classroomData['name'],
                        'en' => $classroomData['name_en'],
                    ],
                    'grade_id' => $classroomData['grade_id'],
                ]);
            }
            return $created;
        });
    }

    public function update(Classroom $classroom, array $data): Classroom
    {
        $classroom->update($data);

        return $classroom;
    }

    public function delete(Classroom $classroom): void
    {
        $classroom->delete();
    }

    public function destroySelected(array $ids): void
    {
        Classroom::destroy($ids);
    }
}
