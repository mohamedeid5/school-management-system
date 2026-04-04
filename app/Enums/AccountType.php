<?php

namespace App\Enums;

enum AccountType: string
{
    case INVOICE = 'invoice';
    case RECEIPT = 'receipt';
}
