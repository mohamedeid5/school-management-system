<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use App\Http\Requests\SettingRequest;

use function Flasher\Toastr\Prime\toastr;

class SettingController extends Controller
{
    public function __construct(protected SettingService $settingService) {}

    public function edit()
    {
        $settingsData = $this->settingService->getAllSettings();
        return view('admin.settings.edit', $settingsData);
    }

    public function update(SettingRequest $request)
    {
        try {
            $this->settingService->updateSettings($request->validated());
            toastr(__('Settings updated successfully'), 'success');
            return redirect()->route('settings.edit');
        } catch (\Exception $e) {
            $this->logError('Error updating settings', $e);
            toastr(__('An error occurred while updating settings'), 'error');
            return redirect()->route('settings.edit');
        }
    }
}


