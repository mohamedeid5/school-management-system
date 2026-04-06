<?php

namespace App\Repositories;

use App\Models\ProcessingFee;
use App\Models\StudentAccount;
use App\Enums\AccountType;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository
{
    public function createProcessingFee($data)
    {
        return DB::transaction(function() use ($data) {
            $processingFee = ProcessingFee::create([
                'date' => now(),
                'student_id' => $data['student_id'],
                'amount' => $data['amount'],
                'description' => $data['description']
            ]);

            StudentAccount::create([
                'date' => now(),
                'type' => AccountType::PROCESSING_FEE,
                'student_id' => $data['student_id'],
                'processing_fee_id' => $processingFee->id,
                'debit' => 0.00,
                'credit' => $data['amount'],
                'description' => $data['description']
            ]);

            return $processingFee;
        });
    }

    public function updateProcessingFee($data, $processingFee)
    {
        return DB::transaction(function() use ($data, $processingFee) {
            $processingFee->update([
                'amount' => $data['amount'],
                'description' => $data['description']
            ]);

            $account = StudentAccount::where('processing_fee_id', $processingFee->id)->first();

            if($account) {
                $account->update([
                    'credit' => $data['amount'],
                    'description' => $data['description']
                ]);
            }

            return $processingFee;
        });
    }

    public function deleteProcessingFee($processingFee)
    {
        return DB::transaction(function() use ($processingFee) {
            $processingFee->delete();

            StudentAccount::where('processing_fee_id', $processingFee->id)->delete();
        });
    }
}
