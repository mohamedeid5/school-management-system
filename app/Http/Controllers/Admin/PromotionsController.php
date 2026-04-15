<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Services\PromotionService;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    public PromotionService $promotionService;

    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function index()
    {
        $data = $this->promotionService->getPromotionPageData();

        return view('admin.promotions.index', $data);
    }

    public function store(PromotionRequest $request)
    {
        try {
            $this->promotionService->promoteStudents($request);

            toastr()->success(__('main.promoted_successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            $this->logError('Error promoting students', $e);
            toastr()->error(__('main.error_occurred'));

            return redirect()->back()->withInput();
        }

    }

    public function management()
    {
        $data = $this->promotionService->getManagementPageData();

        return view('admin.promotions.management', $data);
    }

    public function destroy(Request $request)
    {
        try {
            $this->promotionService->rollbackPromotion($request);

            toastr()->success(__('main.rolled_back_successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            $this->logError('Error rolling back promotion', $e, ['promotion_id' => $request->id]);
            toastr()->error(__('main.error_occurred'));

            return redirect()->back();
        }
    }
}
