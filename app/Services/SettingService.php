<?php

namespace App\Services;

use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\DB;

class SettingService
{
    public function __construct(protected SettingRepository $settingRepository, protected FileService $fileService) {}

    public function getAllSettings()
    {
        return $this->settingRepository->getAll();
    }

    public function updateSettings($data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data as $key => $value) {
            if ($value instanceof \Illuminate\Http\UploadedFile) {
                $setting = $this->settingRepository->updateOrCreate($key, null);

                $this->fileService->deleteOldAttachments($setting);
                $this->fileService->upload($value, $setting, 'settings');
            } else {
                $this->settingRepository->updateOrCreate($key, $value);
            }
        }
        });


    }
}
