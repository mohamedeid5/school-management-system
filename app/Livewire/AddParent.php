<?php

namespace App\Livewire;

use App\Livewire\Forms\ParentForm;
use Livewire\Component;
use App\Models\Nationality;
use App\Models\BloodType;
use App\Models\Religion;
use Livewire\WithFileUploads;
use App\Actions\Parents\CreateParentAction;
use App\Actions\Parents\DeleteParentAction;
use App\Actions\Parents\UpdateParentAction;
use App\Models\MyParent;
use App\Traits\Loggable;

class AddParent extends Component
{
    use WithFileUploads, Loggable;

    public int $currentStep = 1;

    public ParentForm $form;

    public $showTrashed = false;

    public $showForm = false;

    public $updateMode = false;

    public $parent_id;


    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $parents = $this->showTrashed
                ? MyParent::onlyTrashed()->latest()->get()
                : MyParent::latest()->get();

        return view('livewire.add-parent', [
            'nationalities' => Nationality::all(),
            'type_bloods' => BloodType::all(),
            'religions' => Religion::all(),
            'parents' => $parents,
        ]);
    }

    public function firstStepSubmit(): void
    {
        $this->form->validate($this->form->fatherRules());
        $this->currentStep = 2;
    }

    public function secondStepSubmit(): void
    {
        $this->form->validate($this->form->motherRules());
        $this->currentStep = 3;
    }

    public function back($step): void
    {
        $this->currentStep = $step;
    }

    public function edit($id)
    {

        $this->prepareForEdit($id);

        $parent = MyParent::findOrFail($id);

        $this->form->email = $parent->email;
        $this->form->name_father = $parent->getTranslation('name_father', 'ar');
        $this->form->name_father_en = $parent->getTranslation('name_father', 'en');
        $this->form->national_id_father = $parent->national_id_father;
        $this->form->passport_id_father = $parent->passport_id_father;
        $this->form->phone_father = $parent->phone_father;
        $this->form->job_father = $parent->getTranslation('job_father', 'ar');
        $this->form->job_father_en = $parent->getTranslation('job_father', 'en');
        $this->form->nationality_father_id = $parent->nationality_father_id;
        $this->form->blood_type_father_id = $parent->blood_type_father_id;
        $this->form->religion_father_id = $parent->religion_father_id;
        $this->form->address_father = $parent->address_father;

        $this->form->name_mother = $parent->getTranslation('name_mother', 'ar');
        $this->form->name_mother_en = $parent->getTranslation('name_mother', 'en');
        $this->form->national_id_mother = $parent->national_id_mother;
        $this->form->passport_id_mother = $parent->passport_id_mother;
        $this->form->phone_mother = $parent->phone_mother;
        $this->form->job_mother = $parent->getTranslation('job_mother', 'ar');
        $this->form->job_mother_en = $parent->getTranslation('job_mother', 'en');
        $this->form->nationality_mother_id = $parent->nationality_mother_id;
        $this->form->blood_type_mother_id = $parent->blood_type_mother_id;
        $this->form->religion_mother_id = $parent->religion_mother_id;
        $this->form->address_mother = $parent->address_mother;
    }

    public function delete($id, DeleteParentAction $deleteAction)
    {
        try {
            $parent = MyParent::findOrFail($id);
            $deleteAction->handle($parent);

            toastr()->success(__('main.deleted_successfully'));
        } catch (\Exception $e) {
            $this->logError('Parent delete failed', $e);
            toastr()->error(__('main.error_message'));
        }
    }

    public function forceDelete($id, DeleteParentAction $deleteAction)
    {
        try {
            $parent = MyParent::withTrashed()->findOrFail($id);
            $deleteAction->forceDelete($parent);

            toastr()->success(__('main.deleted_successfully'));
        } catch (\Exception $e) {
            $this->logError('Parent delete failed', $e, ['parent_id' => $id]);
            toastr()->error(__('main.error_message'));
        }
    }

    public function restore($id)
    {
        try {
            $parent = MyParent::withTrashed()->findOrFail($id);
            $parent->restore();
        } catch (\Exception $e) {
            $this->logError('Parent delete failed', $e, ['parent_id' => $parent->id]);
            toastr()->error(__('main.error_message'));
        }
    }


    public function toggleTrashed(): void
    {
        $this->showTrashed = !$this->showTrashed;
    }

    protected function prepareForEdit($id): void
    {
        $this->updateMode = true;
        $this->showForm = true;
        $this->parent_id = $id;
        $this->form->id = $id;
    }

    public function submitForm(CreateParentAction $createAction, UpdateParentAction $updateAction): void
    {
        $this->form->validate($this->form->allRules());

        try {
            if($this->updateMode)
            {
                $parent = MyParent::findOrFail($this->parent_id);
                $updateAction->handle($parent, $this->form);
            } else {
                $createAction->handle($this->form);
            }

            $this->resetFormState();
            toastr()->success(__('main.created_successfully'));
        } catch (\Exception $e) {
            $this->logError('Parent creation failed', $e);
            toastr()->error(__('main.error_message'));
        }

        $this->hideForm();
    }

    public function removePhoto($index): void
    {
        unset($this->form->photos[$index]);
        $this->form->photos = array_values($this->form->photos);
    }

    protected function resetFormState(): void
    {
        $this->form->reset();
        $this->resetValidation();
        $this->currentStep = 1;
    }

    public function showCreateForm()
    {
        $this->showForm = true;
    }

    public function hideForm()
    {
        $this->showForm = false;
    }
}
