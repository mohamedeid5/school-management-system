<?php

namespace App\Repositories;

use App\Models\Library;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class LibraryRepository
{
    public function getIndexData(): array
    {
        return [
            'libraries' => Library::with(['grade', 'classroom', 'section', 'subject', 'user'])->latest()->paginate(20),
            'grades'    => Grade::all(),
        ];
    }

    public function create(array $data): Library
    {
        $data['user_id'] = Auth::id();
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
