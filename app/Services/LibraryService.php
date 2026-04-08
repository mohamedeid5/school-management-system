<?php

namespace App\Services;

use App\Repositories\LibraryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LibraryService
{
    public function __construct(protected LibraryRepository $libraryRepository, protected FileService $fileService) {}

    public function getIndexData(): array
    {
        return $this->libraryRepository->getIndexData();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $data['user_id'] = Auth::id();

            $file = $this->libraryRepository->create($data);

            $this->fileService->upload([$data['file_path']], $file, 'libraries');

            return $file;
        });
    }

    public function update($data, $library)
    {
        return DB::transaction(function () use ($data, $library) {
            $this->libraryRepository->update($data, $library);

            if(isset($data['file_path'])) {
                $this->fileService->deleteOldAttachments($library);
                $this->fileService->upload([$data['file_path']], $library, 'libraries');
            }
        });
    }

    public function delete($library)
    {
        return DB::transaction(function () use ($library) {
            $this->fileService->deleteOldAttachments($library);
            $this->libraryRepository->delete($library);
        });
    }

}
