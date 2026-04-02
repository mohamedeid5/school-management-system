<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\GraduationControllerRequest;
use App\Repositories\GraduationRepository;
use App\Services\GraduationService;

class GraduationController extends Controller
{
    protected GraduationService $graduationService;
    protected GraduationRepository $graduationRepository;

    public function __construct(GraduationService $graduationService, GraduationRepository $graduationRepository)
    {
        $this->graduationService = $graduationService;
        $this->graduationRepository = $graduationRepository;
    }

    public function index()
    {
        $data = $this->graduationService->getGraduationPageData();
        return view('graduations.index', $data);
    }

    public function create()
    {
        $data = $this->graduationService->getCreatePageData();

        return view('graduations.create', $data);
    }

    public function store(GraduationControllerRequest $request)
    {
        try {
            $this->graduationService->graduate($request);
            toastr()->success(__('main.created_successfully'));
            return redirect()->route('graduations.index');
        } catch (\Exception $e) {
            $this->logError('graduation creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));
            return redirect()->back();
        }
    }

    public function restore($id)
    {
        try {
            $this->graduationRepository->restore($id);
            toastr()->success(__('main.restored_successfully'));
            return redirect()->route('graduations.index');
        } catch (\Exception $e) {
            $this->logError('graduation restore failed', $e, ['student_id' => $id]);
            toastr()->error(__('main.something_went_wrong'));
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $this->graduationRepository->forceDelete($id);
            toastr()->success(__('main.created_successfully'));
            return redirect()->route('graduations.index');
        } catch (\Exception $e) {
            $this->logError('graduation deletion failed', $e, ['student_id' => $id]);
            toastr()->error(__('main.something_went_wrong'));
            return redirect()->back();
        }
    }
}
