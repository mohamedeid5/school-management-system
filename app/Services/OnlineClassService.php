<?php

namespace App\Services;

use App\Models\OnlineClass;
use App\Repositories\OnlineClassRepository;
use Illuminate\Support\Facades\Auth;

class OnlineClassService
{
    public function __construct(
        protected OnlineClassRepository $onlineClassRepository,
        protected ZoomService $zoomService,
    ) {}

    public function getIndexData(): array
    {
        return $this->onlineClassRepository->getIndexData();
    }

    public function getCreateData(): array
    {
        return $this->onlineClassRepository->getCreateData();
    }

    public function create(array $data): OnlineClass
    {
        if ($data['type'] === 'zoom') {
            $meeting = $this->zoomService->createMeeting([
                'topic'    => $data['title'][app()->getLocale()],
                'start_at' => $data['start_at'],
                'duration' => $data['duration'],
            ]);

            if (isset($meeting['id'])) {
                $data['zoom_meeting_id'] = $meeting['id'];
                $data['join_url']        = $meeting['join_url'] ?? null;
                $data['start_url']       = $meeting['start_url'] ?? null;
            }
        }

        $data['user_id'] = Auth::id();

        return $this->onlineClassRepository->store($data);
    }

    public function update(OnlineClass $onlineClass, array $data): OnlineClass
    {
        return $this->onlineClassRepository->update($onlineClass, $data);
    }

    public function delete(OnlineClass $onlineClass): void
    {
        $this->onlineClassRepository->delete($onlineClass);
    }
}
