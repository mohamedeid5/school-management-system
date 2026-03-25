<?php

namespace App\Livewire;

use App\Livewire\Forms\ParentForm;
use Livewire\Component;
use App\Models\Nationality;
use App\Models\BloodType;
use App\Models\Religion;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use App\Actions\Parents\CreateParentAction;

class AddParent extends Component
{

    use WithFileUploads;

    public int $currentStep = 1;

    public ParentForm $form;


    public function render()
    {
        return view('livewire.add-parent', [
            'nationalities' => Nationality::all(),
            'type_bloods' => BloodType::all(),
            'religions' => Religion::all(),
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

    public function submitForm(CreateParentAction $createParentAction): void
    {
        $this->form->validate($this->form->allRules());

        try {

            $createParentAction->handle($this->form);

            $this->resetFormState();
            toastr()->success(__('main.created_successfully'));
        } catch (\Exception $e) {
            Log::error('Parent creation failed', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            toastr()->error(__('main.error_message'));
        }
    }


    public function removePhoto($index): void
    {
        unset($this->form->photos[$index]);
        $this->form->photos = array_values($this->form->photos);
    }

    public function back($step): void
    {
        $this->currentStep = $step;
    }

    protected function resetFormState(): void
{
    $this->form->reset();
    $this->resetValidation();
    $this->currentStep = 1;
}
}
