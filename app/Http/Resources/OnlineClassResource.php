<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OnlineClassResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title'           => $this->getTranslation('title', app()->getLocale()),
            'type'            => $this->type,
            'subject_id'      => $this->subject_id,
            'grade_id'        => $this->grade_id,
            'classroom_id'    => $this->classroom_id,
            'user_id'         => $this->user_id,
            'start_at'        => $this->start_at?->toDateTimeString(),
            'duration'        => $this->duration,
            'join_url'        => $this->join_url,
            'start_url'       => $this->when($this->start_url, $this->start_url),
            'zoom_meeting_id' => $this->when($this->zoom_meeting_id, $this->zoom_meeting_id),
            'description'     => $this->description,
            'subject'         => new SubjectResource($this->whenLoaded('subject')),
            'grade'           => new GradeResource($this->whenLoaded('grade')),
            'classroom'       => new ClassroomResource($this->whenLoaded('classroom')),
            'teacher'         => $this->whenLoaded('teacher'),
            'created_at'      => $this->created_at?->toDateTimeString(),
        ];
    }
}
