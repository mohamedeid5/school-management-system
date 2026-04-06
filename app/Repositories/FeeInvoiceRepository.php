<?php

namespace App\Repositories;

use App\Enums\AccountType;
use App\Models\FeeInvoice;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class FeeInvoiceRepository
{
    public function storeInvoice($data, $feeAmount)
    {
        return DB::transaction(function () use ($data , $feeAmount) {

            $invoice = FeeInvoice::create([
                'invoice_date' => now(),
                'student_id' => $data['student_id'],
                'fee_id' => $data['fee_id'],
                'amount' => $feeAmount,
                'description' => $data['description']
            ]);

            StudentAccount::create([
                'date' => now(),
                'type' => AccountType::INVOICE,
                'student_id' => $data['student_id'],
                'fee_invoice_id' => $invoice->id,
                'debit' => $feeAmount,
                'credit' => 0,
                'description' => $data['description']
            ]);

            return $invoice;
        });
    }

    public function updateInvoice($data, $feeInvoice, $feeAmount)
    {
        return DB::transaction(function () use ($data, $feeInvoice, $feeAmount) {

            $feeInvoice->update([
                'fee_id' => $data['fee_id'],
                'amount' => $feeAmount,
                'description' => $data['description']
            ]);

            $accountEntry = StudentAccount::where('fee_invoice_id', $feeInvoice->id)->first();

            if ($accountEntry) {
                $accountEntry->update([
                    'debit' => $feeAmount,
                    'description' => $data['description']
                ]);
            }

            return $feeInvoice;
        });
    }

    public function deleteInvoice($feeInvoice)
    {
        return DB::transaction(function () use ($feeInvoice) {
            $feeInvoice->delete();

            StudentAccount::where('fee_invoice_id', $feeInvoice->id)->delete();
        });
    }    
}
