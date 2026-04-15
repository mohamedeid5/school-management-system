<?php

namespace App\Repositories;

use App\Models\Library;
use App\Models\Grade;

class LibraryRepository
{
    public function getIndexData($user): array
    {
        $libraries = Library::authorizedForUser($user)
                ->with(['grade', 'classroom', 'section', 'subject', 'user'])
                ->latest()
                ->get();

        return [
            'libraries' => $libraries,
            'grades'    => Grade::all(),
        ];
    }

    public function create(array $data): Library
    {
        return Library::create($data);
    }

    public function update($data, Library $library)
    {
        $library->update($data);
    }

    public function delete(Library $library)
    {
        $library->delete();
    }
}
