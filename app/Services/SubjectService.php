<?php

namespace App\Services;

use App\Models\Subject;
use App\Repositories\SubjectRepository;

class SubjectService
{
    public function __construct(protected SubjectRepository $subjectRepository) {}

    public function getSubjectIndexData($user)
    {
        return $this->subjectRepository->getSubjectIndexData($user);
    }

    public function createSubject(array $data): Subject
    {
        return $this->subjectRepository->store($data);
    }

    public function updateSubject(Subject $subject, array $data): Subject
    {
        return $this->subjectRepository->update($subject, $data);
    }

    public function deleteSubject(Subject $subject): void
    {
        $this->subjectRepository->delete($subject);
    }
}

