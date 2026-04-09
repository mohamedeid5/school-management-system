<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\GraduationRequest;
use App\Repositories\GraduationRepository;
use App\Services\GraduationService;

use function Flasher\Toastr\Prime\toastr;

class GraduationController extends Controller
{
 
    public function __construct(protected GraduationService $graduationService, protected GraduationRepository $graduationRepository) {}

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

    public function store(GraduationRequest $request)
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
            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('graduations.index');
        } catch (\Exception $e) {
            $this->logError('graduation deletion failed', $e, ['student_id' => $id]);
            toastr()->error(__('main.something_went_wrong'));
            return redirect()->back();
        }
    }
}
