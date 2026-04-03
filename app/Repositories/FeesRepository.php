<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Fee;
use App\Models\Grade;

class FeesRepository
{
    public function getAllFees()
    {
        return Fee::all();
    }

    public function getAllGrades()
    {
        return Grade::all();
    }

    public function getAllClassrooms()
    {
        return Classroom::all();
    }

    public function createFee($request)
    {
        return Fee::create($request);
    }

    public function updateFee($request, $fee)
    {
        return $fee->update($request);
    }

    public function deleteFee($fee)
    {
        return $fee->delete();
    }
}
