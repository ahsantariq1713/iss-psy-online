<div>
    @if($user->proProfileSubmissionRequired())
        <div class="mt-3 ml-3 pl-2">
            <h6 class="font-weight-normal">Verify Your Professional Profile</h6>
            <p class="text-muted small">All required information for your professional profile collected. Please submit profile verification request to get verified.</p>
            <div class="w-100 text-left mb-3 pr-3">
                <button class="btn btn-subtle-success btn-block font-weight-bold" wire:click="submit" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm" wire:loading.delay></span>
                    Submit Profile
                </button>
            </div>
        </div>
    @endif
</div>
