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

    public function createFee($data)
    {
        return Fee::create($data);
    }

    public function updateFee($data, $fee)
    {
        return $fee->update($data);
    }

    public function deleteFee($fee)
    {
        return $fee->delete();
    }
}
