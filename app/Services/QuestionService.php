<?php

namespace App\Services;

use App\Models\Question;
use App\Repositories\QuestionRepository;

class QuestionService
{
    public function __construct(protected QuestionRepository $questionRepository) {}

    public function getQuestionIndexData(): array
    {
        return $this->questionRepository->getQuestionIndexData();
    }

    public function createQuestion(array $data): Question
    {
        return $this->questionRepository->store($data);
    }

    public function updateQuestion(Question $question, array $data): Question
    {
        return $this->questionRepository->update($question, $data);
    }

    public function deleteQuestion(Question $question): void
    {
        $this->questionRepository->delete($question);
    }
}
