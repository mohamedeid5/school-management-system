<?php

namespace App\Services;

use App\Models\Classroom;
use App\Repositories\FeesRepository;

class FeesService
{
    public function __construct(protected FeesRepository $feesRepository) {}

    public function getCreatePageData()
    {
        $classrooms = old('grade_id')
            ? Classroom::where('grade_id', old('grade_id'))->get()
            : collect();

        return [
            'fees' => $this->feesRepository->getAllFees(),
            'grades' => $this->feesRepository->getAllGrades(),
            'classrooms' => $classrooms,
        ];
    }

     public function getEditPageData($fee)
    {
        $gradeId = old('grade_id', $fee->grade_id);
        $classrooms = Classroom::where('grade_id', $gradeId)->get();

        return [
            'fee' => $fee,
            'grades' => $this->feesRepository->getAllGrades(),
            'classrooms' => $classrooms,
        ];
    }

    public function storeFee($data)
    {
        return $this->feesRepository->createFee($data);
    }

    public function updateFee($data, $fee)
    {
        return $this->feesRepository->updateFee($data, $fee);
    }

    public function deleteFee($fee)
    {
        return $this->feesRepository->deleteFee($fee);
    }
}
