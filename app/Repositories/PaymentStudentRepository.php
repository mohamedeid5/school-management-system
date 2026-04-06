<?php

namespace App\Repositories;

use App\Enums\AccountType;
use App\Models\PaymentStudent;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentStudentRepository
{
    public function storePayment($data)
    {
        return DB::transaction(function () use ($data) {
            $payment = PaymentStudent::create([
                'date' => now(),
                'student_id' => $data['student_id'],
                'amount' => $data['amount'],
                'description' => $data['description'] ?? null,
            ]);

            StudentAccount::create([
                'date' => $payment->date,
                'type' => AccountType::PAYMENT,
                'student_id' => $data['student_id'],
                'payment_student_id' => $payment->id,
                'debit' => $data['amount'],
                'credit' => 0,
                'description' => $data['description'] ?? null,
            ]);

            return $payment;
        });
    }

    public function updatePayment($data, $payment)
    {
        return DB::transaction(function () use ($data, $payment) {
            $payment->update([
                'amount' => $data['amount'],
                'description' => $data['description'] ?? null,
            ]);

            $account = StudentAccount::where('payment_student_id', $payment->id)->first();

            if ($account) {
                $account->update([
                    'debit' => $data['amount'],
                    'description' => $data['description'] ?? null,
                ]);
            }

            return $payment;
        });
    }

    public function deletePayment($payment)
    {
        return DB::transaction(function () use ($payment) {
            StudentAccount::where('payment_student_id', $payment->id)->delete();
            $payment->delete();
        });
    }
}
