<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeInvoiceControllerRequest;
use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Student;
use App\Services\FeeInvoiceService;

class FeeInvoiceController extends Controller
{

    public FeeInvoiceService $feeInvoiceService;

    public function __construct(FeeInvoiceService $feeInvoiceService)
    {
        $this->feeInvoiceService = $feeInvoiceService;
    }

    public function index()
    {
        $feeInvoices = FeeInvoice::with('student.user', 'fee')->get();
        
        return view('fee_invoices.index', compact('feeInvoices'));
    }

    public function show(string $id)
    {
        $student = Student::findOrFail($id);

        $fees = Fee::where('grade_id', $student->grade_id)
            ->where('classroom_id', $student->classroom_id)
            ->get();

        return view('fee_invoices.create', compact('student', 'fees'));
    }

    public function store(FeeInvoiceControllerRequest $request)
    {
        try {
            $this->feeInvoiceService->createInvoice($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('fee_invoices.index');
        } catch (\Exception $e) {
            $this->logError('fee invoice creation failed', $e);
            toastr()->error(__('main.created_failed'));
            return redirect()->back()->withInput();
        }
    }

    public function edit(FeeInvoice $feeInvoice)
    {
        $student = $feeInvoice->student;

        $fees = Fee::where('grade_id', $student->grade_id)
            ->where('classroom_id', $student->classroom_id)
            ->get();

        return view('fee_invoices.edit', compact('feeInvoice', 'student', 'fees'));
    }

    public function update(FeeInvoiceControllerRequest $request, FeeInvoice $feeInvoice)
    {
        try {
            $this->feeInvoiceService->updateInvoice($request->validated(), $feeInvoice);

            toastr()->success(__('main.updated_successfully'));
            return redirect()->route('fee_invoices.index');
        } catch (\Exception $e) {
            $this->logError('fee invoice update failed', $e);
            toastr()->error(__('main.updated_failed'));
            return redirect()->back()->withInput();
        }
    }

    public function destroy(FeeInvoice $feeInvoice)
    {
        try {
            $this->feeInvoiceService->deleteInvoice($feeInvoice);

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('fee_invoices.index');
        } catch (\Exception $e) {
            $this->logError('fee invoice deletion failed', $e);
            toastr()->error(__('main.deleted_failed'));
            return redirect()->back();
        }
    }
}
