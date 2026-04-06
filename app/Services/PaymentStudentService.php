<?php

namespace App\Services;

use App\Repositories\PaymentStudentRepository;

class PaymentStudentService
{
    public function __construct(protected PaymentStudentRepository $paymentStudentRepository) {}

    public function storePayment($data)
    {
        return $this->paymentStudentRepository->storePayment($data);
    }

    public function updatePayment($data, $payment)
    {
        return $this->paymentStudentRepository->updatePayment($data, $payment);
    }

    public function deletePayment($payment)
    {
        return $this->paymentStudentRepository->deletePayment($payment);
    }
}
