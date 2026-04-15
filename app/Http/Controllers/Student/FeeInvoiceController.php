<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\FeeInvoice;
use Illuminate\Support\Facades\Auth;

class FeeInvoiceController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        if (!$student) abort(403);

        $feeInvoices = FeeInvoice::with('fee')
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('student.fee_invoices.index', compact('feeInvoices'));
    }

    public function show(FeeInvoice $feeInvoice)
    {
        $student = Auth::user()->student;

        if ($feeInvoice->student_id !== $student->id) {
            abort(403);
        }

        $feeInvoice->load('fee', 'student.user');

        return view('student.fee_invoices.show', compact('feeInvoice'));
    }
}
