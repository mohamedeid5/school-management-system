<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use function Flasher\Toastr\Prime\toastr;

class FileController extends Controller
{

    public FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function download($id)
    {
        return $this->fileService->download($id);
    }

    public function delete($id)
    {
        $this->fileService->delete($id);
        toastr()->success(__('main.deleted_successfully'));

        return redirect()->back()->with('success', __('main.deleted_successfully'));

    }
}
