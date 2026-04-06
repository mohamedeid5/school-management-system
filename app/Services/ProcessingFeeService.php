<?php

namespace App\Services;

use App\Repositories\ProcessingFeeRepository;

class ProcessingFeeService
{
    public function __construct(protected ProcessingFeeRepository $processingFeeRepository) {}

    public function createProcessingFee($data)
    {
        return $this->processingFeeRepository->createProcessingFee($data);
    }

    public function updateProcessingFee($data, $processingFee)
    {
        return $this->processingFeeRepository->updateProcessingFee($data, $processingFee);
    }

    public function deleteProcessingFee($processingFee)
    {
        return $this->processingFeeRepository->deleteProcessingFee($processingFee);
    }
}
