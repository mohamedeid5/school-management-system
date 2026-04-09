<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeesRequest;
use App\Models\Fee;
use App\Repositories\FeesRepository;
use App\Services\FeesService;

class FeesController extends Controller
{


    public function __construct(protected FeesService $feesService, protected FeesRepository $feesRepository) {}

    public function index()
    {
        $fees = $this->feesRepository->getAllFees();

        return view('fees.index', compact('fees'));
    }

    public function create()
    {
        $data = $this->feesService->getCreatePageData();

        return view('fees.create', $data);
    }

    public function store(FeesRequest $request)
    {
         try {
            $this->feesService->storeFee($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('fees.index');
        } catch (\Exception $e) {
            $this->logError('fee creation failed', $e);
            toastr()->error(__('main.created_failed'));
            return redirect()->back()->withInput();
        }
    }

    public function edit(Fee $fee)
    {
        $data = $this->feesService->getEditPageData($fee);
        return view('fees.edit', $data);
    }

    public function update(FeesRequest $request, Fee $fee)
    {
        try {
            $this->feesService->updateFee($request->validated(), $fee);

            toastr()->success(__('main.updateed_successfully'));
            return redirect()->route('fees.index');
        } catch (\Exception $e) {
            $this->logError('fee update failed', $e, ['fee_id' => $fee->id]);
            toastr()->error(__('main.created_failed'));
            return redirect()->back()->withInput();
        }
    }


    public function destroy(Fee $fee)
    {
        try {
            $this->feesService->deleteFee($fee);

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('fees.index');
        } catch (\Exception $e) {
            $this->logError('fee deletion failed', $e, ['fee_id' => $fee->id]);
            toastr()->error(__('main.deleted_failed'));
            return redirect()->back();
        }
    }

}
