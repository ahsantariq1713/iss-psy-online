<div class="page-sidebar border-top">
    <header class="sidebar-header d-xl-none">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="#" onclick="Looper.toggleSidebar()"><i
                            class="breadcrumb-icon fa fa-angle-left mr-2"></i>Back</a>
                </li>
            </ol>
        </nav>
    </header>
    @if(not_null($therapist))
    <div>
        <div class="sidebar-section sidebar-section-fill">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="page-title">
                        <img src="{{ asset($therapist->avatar) }}" class="rounded-circle" height="30" width="30" /></i>
                        {{$therapist->license->academic_title}}. {{$therapist->name}}
                    </h1>
                    <p class="text-muted"> {{$therapist->email}} - {{$therapist->country}} </p>
                </div>
                @if($therapist['profileLog']['status'] == 'Under Review')
                <div>
                    <p class="text-muted m-0 text-right mb-1">Verification Request</p>
                    <button class="btn btn-subtle-danger" wire:click='disapprove' wire:loading.attr='disabled'>
                        <span class="spinner-border spinner-border-sm" wire:loading.delay
                            wire:target='disapprove'></span>
                        Disapprove
                    </button>
                    <button class="btn btn-subtle-success" wire:click='approve' wire:loading.attr='disabled'>
                        <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target='approve'></span>
                        Approve
                    </button>
            </div>
                @endif
            </div>
            <div class="nav-scroller border-bottom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#basic-info">Basic Info</a>

                    </li>
                    @if($therapist->profileLog->status != 'Incomplete')
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#professional-profile">Professional Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#working-hours">Working Hours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#pricing-payment">Pricing & Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#education">Education</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#experience">Experience</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="tab-content pt-4">
                @include('livewire.therapist-details.tab-basic-info')
                @if($therapist->profileLog->status != 'Incomplete')
                @include('livewire.therapist-details.tab-professional-profile')
                @include('livewire.therapist-details.tab-working-hours')
                @include('livewire.therapist-details.tab-pricing-payment')
                @include('livewire.therapist-details.tab-education')
                @include('livewire.therapist-details.tab-experience')
                @endif
            </div>
        </div>
    </div>
    @endif
    <script type="text/javascript">
        document.addEventListener('livewire:load' , ()=>{
        window.livewire.on('toggleSidebar',()=> window.Looper.toggleSidebar())
    });
    </script>
</div>
