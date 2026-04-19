<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\FeeInvoice;

class FeeInvoiceController extends Controller
{
    public function index()
    {

        $parent   = auth()->user()->parent;
        $children = $parent->children()->with('user')->get();

        $allInvocies = FeeInvoice::whereIn('student_id', $children->pluck('id'))->get();

        $children->each(function($child) use ($allInvocies) {
            $feeInvoices = $allInvocies->where('student_id', $child->id);
            $child->invoices = $feeInvoices;
            $child->totalAmount = $feeInvoices->sum('amount');

        });

        return view('parent.fee_invoices.index', compact('children'));
    }
}
