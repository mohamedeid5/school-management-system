<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProcessingFeeService;
use App\Models\Student;
use App\Http\Requests\ProcessingFeeRequest;
use App\Models\ProcessingFee;

class ProcessingFeeController extends Controller
{

    public function __construct(protected ProcessingFeeService $processingFeeService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $processing_fees = ProcessingFee::with('student.user')->get();
        return view('admin.processing_fees.index', compact('processing_fees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProcessingFeeRequest $request)
    {
        try {
            $this->processingFeeService->createProcessingFee($request->validated());
            toastr()->success(__('main.created_successfully'));
            return redirect()->route('processing-fees.index');
        } catch (\Exception $e) {
  $this->logError('processing fee creation failed', $e);
            toastr()->error(__('main.created_failed'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.processing_fees.create', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProcessingFee $processingFee)
    {
        return view('admin.processing_fees.edit', compact('processingFee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProcessingFeeRequest $request, ProcessingFee $processingFee)
    {
        try {
            $this->processingFeeService->updateProcessingFee($request->validated(), $processingFee);
            toastr()->success(__('main.updated_successfully'));
            return redirect()->route('processing-fees.index');
        } catch (\Exception $e) {
            $this->logError('processing fee update failed', $e, ['processing_fee_id' => $processingFee->id]);
            toastr()->error(__('main.updated_failed'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProcessingFee $processingFee)
    {
        try {
            $this->processingFeeService->deleteProcessingFee($processingFee);
            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('processing-fees.index');
        } catch (\Exception $e) {
            $this->logError('processing fee deletion failed', $e, ['processing_fee_id' => $processingFee->id]);
            toastr()->error(__('main.deleted_failed'));
            return redirect()->back();
        }
    }
}
