<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{
    public function getAll()
    {
        $settingsData = Setting::with('attachments')->get();
        $settings = $settingsData->pluck('value', 'key');

        $attachments = $settingsData->keyBy('key');

        return [
            'settings' => $settings,
            'attachments' => $attachments,
        ];
    }

    public function updateOrCreate($key, $value)
    {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value],
        );
    }
}
