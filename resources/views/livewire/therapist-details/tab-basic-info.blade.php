<div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="client-billing-contact-tab">
    <div class="card">
        <div class="card-header pb-0 bg-light">
            <h2 id="client-billing-contact-tab m-0" class="card-title"> Basic Info </h2>
        </div>
        <div class="card-body" style="padding:0px 10px!important">
            <!-- full name -->
            <div class="row py-2">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Full Name</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->name}}
                </div>
            </div>
            <!-- email -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Email Address</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->email}}
                    <p class="m-0 small text-muted">verified on
                        {{$therapist->email_verified_at->calendar()}}</p>
                </div>
            </div>
            <!-- phone -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Phone</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->phone ?? 'NA'}}
                    @if(not_null($therapist->phone))
                    <p class="m-0 small text-muted">verified on
                        {{$therapist->phone_verified_at->calendar()}}</p>
                    @endif
                </div>
            </div>
            <!-- birthday -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Birthday</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->birthday}}
                </div>
            </div>
            <!-- gender -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Gender</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->gender}}
                </div>
            </div>
            <!-- active -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Account Status</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @if($therapist->active)
                    <span class="mdi mdi-check text-success"></span> Active
                    @else
                    <span class="mdi mdi-close text-danger"></span> Blocked
                    @endif
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">
                    <span class="spinner-border spinner-border-sm font-weight-bold" wire:loading.delay
                        wire:target='toggleActive'></span>
                    <label class="switcher-control switcher-control-success">
                        <input type="checkbox" class="switcher-input" {{$therapist->active ? 'checked' : ''}}
                            wire:click='toggleActive' wire:loading.attr='disabled'>
                        <span class="switcher-indicator"></span>
                    </label>
                </div>
            </div>
            <!-- pro profile status -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Professional Profile</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @php
                    $profile_status = 'success';
                    if($therapist->profileLog->status == 'Under Review') $profile_status = 'warning';
                    else if($therapist->profileLog->status == 'Approved') $profile_status = 'success';
                    else $profile_status = 'danger';
                    @endphp
                    <span class="badge badge-{{$profile_status}}">
                        {{$therapist->profileLog->status}}</span>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">
                    @if($therapist->profileLog->status == 'Under Review')
                    <a data-toggle="tab" href="#verification-request" class="btn-link small">Show Request <i
                            class="mdi mdi-arrow-right"></i> </a>
                    @endif
                </div>
            </div>
            <!-- subscribed newsletter -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Subscribed Newsletter</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->subscribed_newsletter ? 'Yes' : 'No'}}
                </div>
            </div>
            <!-- country -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Country</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->country}}
                </div>
            </div>
            <!-- time zone -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Time Zone</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->timezone}}
                </div>
            </div>
        </div>
    </div>
</div>
