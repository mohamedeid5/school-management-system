<?php

namespace App\Repositories;

use App\Enums\AccountType;
use App\Models\ReceiptStudent;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository
{
    public function storeReceipt($data)
    {
        return DB::transaction(function() use ($data) {

            $receipt = ReceiptStudent::create([
                'date' => now(),
                'student_id' => $data['student_id'],
                'amount' => $data['amount'],
                'description' => $data['description']
            ]);

            StudentAccount::create([
                'date' => $receipt->date,
                'type' => AccountType::RECEIPT,
                'student_id' => $data['student_id'],
                'receipt_student_id' => $receipt->id,
                'debit' => 0,
                'credit' => $data['amount'],
                'description' => $data['description']
            ]);

            return $receipt;
        });
    }

    public function updateReceipt($data, $receipt)
    {
        return DB::transaction(function() use ($data, $receipt) {
            $receipt->update([
                'amount' => $data['amount'],
                'description' => $data['description']
            ]);

            $account = StudentAccount::where('receipt_student_id', $receipt->id)->first();

            if($account) {
                $account->update([
                    'credit' => $data['amount'],
                    'description' => $data['description']
                ]);
            }
            return $receipt;
        });
    }

    public function deleteReceipt($receipt)
    {
        return DB::transaction(function() use ($receipt) {
            $account = StudentAccount::where('receipt_student_id', $receipt->id)->first();

            if($account) {
                $account->delete();
            }

            $receipt->delete();
        });
    }
}
