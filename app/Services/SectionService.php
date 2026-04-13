<?php

namespace App\Services;

use App\Models\Section;
use App\Repositories\SectionRepository;

class SectionService
{
    public function __construct(protected SectionRepository $sectionRepository) {}

    public function getIndexData(): array
    {
        return $this->sectionRepository->getIndexData();
    }

    public function create(array $data): Section
    {
        return $this->sectionRepository->create($data);
    }

    public function update(Section $section, array $data): Section
    {
        return $this->sectionRepository->update($section, $data);
    }

    public function delete(Section $section): void
    {
        $this->sectionRepository->delete($section);
    }
}
