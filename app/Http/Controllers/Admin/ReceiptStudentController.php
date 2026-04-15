<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReceiptStudentService;
use App\Http\Requests\ReceiptStudentRequest;
use App\Models\ReceiptStudent;
use App\Models\Student;

class ReceiptStudentController extends Controller
{
    public function __construct(protected ReceiptStudentService $receiptStudentService) {}

    public function index()
    {
        $receipts = ReceiptStudent::with('student.user')->get();
        return view('admin.receipt_students.index', compact('receipts'));
    }

    public function show($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.receipt_students.create', compact('student'));
    }

    public function store(ReceiptStudentRequest $request)
    {
        try {
            $this->receiptStudentService->storeReceipt($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('receipt-students.index');
        } catch (\Exception $e) {
            $this->logError('Receipt creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function edit(ReceiptStudent $receipt_student)
    {
        $receipt_student->load('student.user');
        return view('admin.receipt_students.edit', compact('receipt_student'));
    }

    public function update(ReceiptStudentRequest $request, ReceiptStudent $receipt_student)
    {
        try {
            $this->receiptStudentService->updateReceipt($request->validated(), $receipt_student);

            toastr()->success(__('main.updated_successfully'));
            return redirect()->route('receipt-students.index');
        } catch (\Exception $e) {
            $this->logError('Receipt update failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function destroy(ReceiptStudent $receipt_student)
    {
        try {
            $this->receiptStudentService->deleteReceipt($receipt_student);

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('receipt-students.index');
        } catch (\Exception $e) {
            $this->logError('Receipt deletion failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }
}
