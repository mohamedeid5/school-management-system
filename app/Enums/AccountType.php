<?php

namespace App\Enums;

enum AccountType: string
{
    case INVOICE = 'invoice';
    case RECEIPT = 'receipt';
    case PROCESSING_FEE = 'processing_fee';
    case PAYMENT = 'payment';
}
