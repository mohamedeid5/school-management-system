<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
            <p>{{ __('main.father_information') }}</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
            <p>{{ __('main.mother_information') }}</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}">3</a>
            <p>{{ __('main.confirm_information') }}</p>
        </div>
    </div>
</div>
