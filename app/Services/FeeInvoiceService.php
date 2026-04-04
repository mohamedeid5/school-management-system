<?php

namespace App\Services;

use App\Models\Fee;
use App\Repositories\FeeInvoiceRepository;

class FeeInvoiceService
{

    public function __construct(protected FeeInvoiceRepository $feeInvoiceRepository)
    {
    }
    public function createInvoice($data)
    {
        $fee = Fee::findOrFail($data['fee_id']);

        return $this->feeInvoiceRepository->storeInvoice($data, $fee->amount);
    }

    public function updateInvoice($data, $feeInvoice)
    {
        $fee = Fee::findOrFail($data['fee_id']);

        return $this->feeInvoiceRepository->updateInvoice($data, $feeInvoice, $fee->amount);
    }

    public function deleteInvoice($invoice)
    {
        return $this->feeInvoiceRepository->deleteInvoice($invoice);
    }
}
