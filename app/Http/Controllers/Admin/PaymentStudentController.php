<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStudentRequest;
use App\Models\PaymentStudent;
use App\Models\Student;
use App\Services\PaymentStudentService;

class PaymentStudentController extends Controller
{
    public function __construct(protected PaymentStudentService $paymentStudentService) {}

    public function index()
    {
        $payments = PaymentStudent::with('student.user')->get();
        return view('admin.payment_students.index', compact('payments'));
    }

    public function create()
    {
        //
    }

    public function store(PaymentStudentRequest $request)
    {
        try {
            $this->paymentStudentService->storePayment($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('payment-students.index');
        } catch (\Exception $e) {
            $this->logError('Payment Student creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back()->withInput();
        }
    }

    public function show(string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.payment_students.create', compact('student'));
    }

    public function edit(PaymentStudent $payment_student)
    {
        $payment_student->load('student.user');
        return view('admin.payment_students.edit', compact('payment_student'));
    }

    public function update(PaymentStudentRequest $request, PaymentStudent $payment_student)
    {
        try {
            $this->paymentStudentService->updatePayment($request->validated(), $payment_student);

            toastr()->success(__('main.updated_successfully'));
            return redirect()->route('payment-students.index');
        } catch (\Exception $e) {
            $this->logError('Payment Student update failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back()->withInput();
        }
    }

    public function destroy(PaymentStudent $payment_student)
    {
        try {
            $this->paymentStudentService->deletePayment($payment_student);

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('payment-students.index');
        } catch (\Exception $e) {
            $this->logError('Payment Student deletion failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }
}
