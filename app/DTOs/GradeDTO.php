<?php

namespace App\DTOs;

final readonly class GradeDTO
{
    public function __construct(
        public string $nameAr,
        public string $nameEn,
        public ?string $notes,
    ) {}

    public static function fromRequest($request)
    {
        $validated = $request->validated();

        return new self(
            nameAr: $validated['name']['ar'],
            nameEn: $validated['name']['en'],
            notes: $validated['notes'],
        );
    }
}
