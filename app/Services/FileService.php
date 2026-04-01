<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;

class FileService
{
    public function upload($files, $model, $folderName, $disk = 'attachments')
    {
        foreach ($files as $file) {

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::slug($originalName) . '-' . time() . '.' . $extension;

            $path = $folderName . '/' . $model->id;

            $file->storeAs($path, $fileName, $disk);

            $model->attachments()->create([
                'file_name' => $fileName,
            ]);
        }
    }

    public function download($id)
    {
        $attachment = Attachment::findOrFail($id);

        $relativePath = $this->getFilePath($attachment);

        if (!Storage::disk('attachments')->exists($relativePath)) {
            abort(404, 'File not found');
        }
        return Storage::disk('attachments')->download($relativePath);
    }

    public function delete($id)
    {
        $attachment = Attachment::findOrFail($id);

        $relativePath = $this->getFilePath($attachment);

        if (Storage::disk('attachments')->exists($relativePath)) {
            Storage::disk('attachments')->delete($relativePath);
        }

        $attachment->delete();

    }

    private function getFilePath($attachment)
    {
        $folder = strtolower(class_basename($attachment->attachable_type)) . 's';

        return "{$folder}/{$attachment->attachable_id}/" . $attachment->file_name;
    }
}
