<?php

namespace App\Services;

use App\Repositories\LibraryRepository;
use Illuminate\Support\Facades\DB;

class LibraryService
{
    public function __construct(protected LibraryRepository $libraryRepository) {}

    public function getIndexData(): array
    {
        return $this->libraryRepository->getIndexData();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $file = $this->libraryRepository->create($data);

            FileService::upload([$data['file_path']], $file, 'libraries');

            return $file;
        });
    }

    public function update($data, $library)
    {
        return DB::transaction(function () use ($data, $library) {
            $this->libraryRepository->update($data, $library);

            if(isset($data['file_path'])) {
                FileService::deleteOldAttachments($library);
                FileService::upload([$data['file_path']], $library, 'libraries');
            }
        });
    }

    public function delete($library)
    {
        return DB::transaction(function () use ($library) {
            FileService::deleteOldAttachments($library);
            $this->libraryRepository->delete($library);
        });
    }

}
