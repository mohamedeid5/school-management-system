<?php

namespace App\Services;

use App\Repositories\ReceiptStudentRepository;

class ReceiptStudentService
{
    public function __construct(protected ReceiptStudentRepository $receiptRepository) {}

    public function storeReceipt($data)
    {
        return $this->receiptRepository->storeReceipt($data);
    }

    public function updateReceipt($data, $receipt)
    {
        return $this->receiptRepository->updateReceipt($data, $receipt);
    }

    public function deleteReceipt($receipt)
    {
        return $this->receiptRepository->deleteReceipt($receipt);
    }
}
