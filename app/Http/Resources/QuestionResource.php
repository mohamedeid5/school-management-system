<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'question'       => $this->getTranslations('question'),
            'type'           => $this->type->label(),
            'marks'          => $this->marks,
            'option_a'       => $this->option_a,
            'option_b'       => $this->option_b,
            'option_c'       => $this->option_c,
            'option_d'       => $this->option_d,
            'correct_answer' => $this->correct_answer,
            'exam_id'        => $this->exam_id,
            'exam'           => new ExamResource($this->whenLoaded('exam')),
        ];
    }
}
