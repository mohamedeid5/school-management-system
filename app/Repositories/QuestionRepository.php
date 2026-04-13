<?php

namespace App\Repositories;

use App\Models\Question;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class QuestionRepository
{
    public function getQuestionIndexData(): array
    {

        $user = Auth::user();

        $questions = Question::authorizedForUser($user)->latest()->get();

        return [
            'grades'    => Grade::all(),
            'questions' =>  $questions,
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
