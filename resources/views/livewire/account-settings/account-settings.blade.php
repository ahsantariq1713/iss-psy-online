<div>
    <header class="page-title-bar text-center mt-5">
        <h4 class="font-weight-normal">Account Settings</h4>
        <p class="text-muted">Settings and recommendations to help you keep your account secure.</p>
    </header>
    <div class="page-section">
        <div class="section-block mb-4">
            @include('livewire.account-settings.profile-picture')
        </div>
        <div class="section-block mb-4">
            @include('livewire.account-settings.basic-info')
        </div>
        <div class="section-block">
            @include('livewire.account-settings.account-access')
        </div>
        @if(Auth::user()->isClient())
            <div class="section-block">
                @include('livewire.account-settings.emergency-phone')
            </div>
        @endif
        <div class="section-block">
            @include('livewire.account-settings.password-settings')
        </div>
        <div class="section-block mb-4">
            @include('livewire.account-settings.country-region')
        </div>
    </div>
</div>
