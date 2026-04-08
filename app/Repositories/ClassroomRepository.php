<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class ClassroomRepository
{
    public function getIndexData(array $filters = []): array
    {
        return [
            'grades'     => Grade::all(),
            'classrooms' => Classroom::with('grade')
                ->when($filters['grade_id'] ?? null, function ($query) use ($filters) {
                    $query->where('grade_id', $filters['grade_id']);
                })
                ->latest()
                ->get(),
        ];
    }

    public function create(array $listClassrooms): void
    {
        DB::transaction(function () use ($listClassrooms) {
            foreach ($listClassrooms as $classroomData) {
                Classroom::create([
                    'name' => [
                        'ar' => $classroomData['name'],
                        'en' => $classroomData['name_en'],
                    ],
                    'grade_id' => $classroomData['grade_id'],
                ]);
            }
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
