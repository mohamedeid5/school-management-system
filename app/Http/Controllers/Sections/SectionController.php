<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use App\Services\SectionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SectionController extends Controller
{
    public function __construct(protected SectionService $sectionService) {}

    public function index(): View
    {
        $data = $this->sectionService->getIndexData();

        return view('sections.index', $data);
    }

    public function store(SectionRequest $request): RedirectResponse
    {
        try {
            $this->sectionService->create($request->validated());

            toastr()->success(__('main.created_successfully'));
            return redirect()->route('sections.index');

        } catch (\Exception $e) {
            $this->logError('Section creation failed', $e);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function update(SectionRequest $request, Section $section): RedirectResponse
    {
        try {
            $this->sectionService->update($section, $request->validated());

            toastr()->success(__('main.updated_successfully'));
            return redirect()->route('sections.index');

        } catch (\Exception $e) {
            $this->logError('Section update failed', $e, ['section_id' => $section->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }

    public function destroy(Section $section): RedirectResponse
    {
        try {
            $this->sectionService->delete($section);

            toastr()->success(__('main.deleted_successfully'));
            return redirect()->route('sections.index');

        } catch (\Exception $e) {
            $this->logError('Section delete failed', $e, ['section_id' => $section->id]);
            toastr()->error(__('main.something_went_wrong'));

            return redirect()->back();
        }
    }
}
