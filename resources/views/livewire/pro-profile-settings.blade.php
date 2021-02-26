<div>
    <header class="page-title-bar text-center mt-5">
        <h4 class="font-weight-normal">Professional Profile</h4>
        <p class="text-muted">Setup your professional profile to start using psychologists online services.</p>
    </header>
    <div class="page-section">
        <livewire:pro-profile-steps active="{{$page}}"/>
        @switch($page)
            @case('identity')
            <livewire:setup-identity/>
            @break
            @case('license')
            <livewire:setup-practice-license/>
            @break
            @case('education')
            <div class="row pt-4">
                <div class="col-12 col-md-12 col-lg-8 offset-lg-2 mt-5">
                    <livewire:educations/>
                    <div class="d-flex justify-content-end">
                        <a href="javascript:void(0)" wire:click="gotoExperience" class="btn btn-primary">Save and Next</a>
                    </div>
                </div>
            </div>
            @break
            @case('experience')
            <div class="row pt-4">
                <div class="col-12 col-md-12 col-lg-8 offset-lg-2 mt-5">
                    <livewire:experiences/>
                    <div class="d-flex justify-content-end">
                        <a href="javascript:void(0)" wire:click="gotoRoster" class="btn btn-primary">Save and Next</a>
                    </div>
                </div>
            </div>
            @break
            @case('roster')
            <livewire:setup-roster/>
            @break
            @case('sessions')
            @if(not($profileLog->roster))
                <script>
                    window.location.href = '/therapist-portal/professional-profile/roster'
                </script>
            @else
                <livewire:setup-sessions/>
            @endif
            @break
            @case('pricing')
            @if(not($profileLog->roster))
                <script>
                    window.location.href = '/therapist-portal/professional-profile/roster'
                </script>
            @else
            <livewire:setup-pricing/>
            @endif
            @break
            @case('payment')
            <livewire:setup-payment/>
            @break
        @endswitch
    </div>
    <script>
        document.addEventListener('livewire:load', function (){
            $("#nav-item-proProfile").addClass("active");
        })
    </script>

</div>
