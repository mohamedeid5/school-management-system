<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\Question;

class QuestionRepository
{
    public function getQuestionIndexData(): array
    {
        return [
            'exams'     => Exam::all(),
            'questions' => Question::with('exam')->latest()->paginate(20),
        ];
    }

    public function store(array $data): Question
    {
        return Question::create($data);
    }

    public function update(Question $question, array $data): Question
    {
        $question->update($data);

        return $question;
    }

    public function delete(Question $question): void
    {
        $question->delete();
    }
}
