<?php

namespace App\Services;

use App\Repositories\PromotionRepository;
use Illuminate\Support\Facades\DB;

class PromotionService
{
    public PromotionRepository $promotionRepository;

    public function __construct(PromotionRepository $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    public function getPromotionPageData()
    {

       $from_classrooms = old('from_grade_id')
            ? $this->promotionRepository->getClassrooms(old('from_grade_id'))
            : collect();

        $from_sections = old('from_classroom_id')
                ? $this->promotionRepository->getSections(old('from_classroom_id'))
                : collect();

        $to_classrooms = old('to_grade_id')
                ? $this->promotionRepository->getClassrooms(old('to_grade_id'))
                : collect();

        $to_sections = old('to_classroom_id')
                ? $this->promotionRepository->getSections(old('to_classroom_id'))
                : collect();

        return [
            'grades' => $this->promotionRepository->getGrades(),
            'from_classrooms' => $from_classrooms,
            'from_sections'   => $from_sections,
            'to_classrooms'   => $to_classrooms,
            'to_sections'     => $to_sections,
        ];

    }

    public function promoteStudents($request)
    {
        return DB::transaction(function () use ($request) {
            return $this->promotionRepository->promote($request);

        });
    }

    public function getManagementPageData()
    {
        return [
            'promotions' => $this->promotionRepository->getAllPromotions(),
        ];
    }

    public function rollbackPromotion($request)
    {
        return $this->promotionRepository->restore($request);
    }
}
