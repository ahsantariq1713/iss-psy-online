<div>
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="/clients"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Overview</a>
                </li>
            </ol>
        </nav>
        <h1 class="page-title mr-sm-auto">
            Therapist Details
        </h1>
    </header>

    <div class="d-flex justify-content-between px-3 py-3">
        <div>
            <h2 id="therapist-billing-contact-tab" class="card-title mb-0 pb-0"> {{ $therapist->name }} </h2>
            <span class="text-muted small">Therapist</span>
            @if($therapist->profileLog->status == 'Under Review')
            <div class="text-left mt-2">
                <p class="text-muted m-0 mb-1">Verification Request</p>
                <button class="btn btn-sm btn-subtle-danger" wire:click='disapprove' wire:loading.attr='disabled'>
                    <span class="spinner-border spinner-border-sm" wire:loading.delay
                        wire:target='disapprove'></span>
                    Disapprove
                </button>
                <button class="btn btn-sm btn-subtle-success" wire:click='approve' wire:loading.attr='disabled'>
                    <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target='approve'></span>
                    Approve
                </button>
            </div>
            @endif
        </div>
        <img class="rounded-circle" src="{{ asset($therapist->avatar) }}" height="100" width="100" alt="">
    </div>

    <div class="row mb-4">
        <div class="col-12">
         <h5 class="mb-3">Appointments Overview</h5>
        </div>
         <div class="col">
             <a href="{{url('/admin-portal/therapists?profileStatus=Pending')}}" class="text-decoration-none text-dark">
                 <div class="metric metric-bordered bg-white">
                     <h2 class="metric-label"> Pending </h2>
                     <p class="metric-value h1">
                         <span class="value">{{$appCount["pending"]}}</span>
                     </p>
                 </div>
             </a>
         </div>
         <div class="col">
            <a href="{{url('/admin-portal/therapists?profileStatus=Pending')}}" class="text-decoration-none text-dark">
                <div class="metric metric-bordered bg-white">
                    <h2 class="metric-label"> Active </h2>
                    <p class="metric-value h1">
                        <span class="value">{{$appCount["active"]}}</span>
                    </p>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{url('/admin-portal/therapists?profileStatus=Pending')}}" class="text-decoration-none text-dark">
                <div class="metric metric-bordered bg-white">
                    <h2 class="metric-label"> Completed </h2>
                    <p class="metric-value h1">
                        <span class="value">{{$appCount["completed"]}}</span>
                    </p>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{url('/admin-portal/therapists?profileStatus=Pending')}}" class="text-decoration-none text-dark">
                <div class="metric metric-bordered bg-white">
                    <h2 class="metric-label"> Canceled </h2>
                    <p class="metric-value h1">
                        <span class="value">{{$appCount["canceled"]}}</span>
                    </p>
                </div>
            </a>
        </div>
    </div>


    <div class="card card-fluid">
        <li class="list-group-header">Basic Info</li>
        <div class="list-group list-group-flush list-group-bordered">
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Email</span>
                <span>{{ $therapist->email }}</span>
            </div>

            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Phone</span>
                <span>{{ $therapist->phone }}</span>
            </div>

            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Gender</span>
                <span>{{ $therapist->gender }}</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Birthday</span>
                <span>{{ $therapist->birthday }}</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Location</span>
                <span>{{ $therapist->country }}</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Time Zone</span>
                <span>{{ $therapist->timezone }}</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Newsletter Subscription</span>
                <span>{{ $therapist->subscribed_newsletter ? 'Yes' : 'No' }}</span>
            </div>
        </div>
    </div>

    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">Account</li>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Status</span>
                <div class="text-right0">
                    <span>
                        @if ($therapist->active)
                            <span class="mdi mdi-check text-success"></span> Active
                        @else
                            <span class="mdi mdi-close text-danger"></span> Blocked
                        @endif
                    </span><br>
                    <div class="text-right">
                        <span class="spinner-border spinner-border-sm font-weight-bold" wire:loading.delay
                            wire:target='toggleActive'></span>
                        <label class="switcher-control switcher-control-success">
                            <input type="checkbox" class="switcher-input" {{ $therapist->active ? 'checked' : '' }}
                                wire:click='toggleActive' wire:loading.attr='disabled'>
                            <span class="switcher-indicator"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Created</span>
                <span>{{ $therapist->created_at->format('d M, Y') }}</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Email Verified</span>
                <span>{{ $therapist->whenEmailVerified() }}</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Phone Verified</span>
                <span>{{ $therapist->whenPhoneVerified() }}</span>
            </div>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span class="text-muted">Last Password Changed</span>
                <span>{{ $therapist->whenPasswordChanged() }}</span>
            </div>
        </div>
    </div>

    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div>Identity</div>
                @if ($therapist->profileLog->identity)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->profileLog->identity)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">National ID</span>
                    <div class="text-right">
                        <span>{{ $therapist->identity->nat_id }}</span><br>
                        @if (not_null($therapist->identity->nat_doc))
                            <livewire:download-doc-button :obj="$therapist->identity" property="nat_doc" />
                        @endif
                    </div>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Passport No.</span>
                    <div class="text-right">
                        <span>{{ $therapist->identity->passport_no }}</span><br>
                        @if (not_null($therapist->identity->passport_doc))
                            <livewire:download-doc-button :obj="$therapist->identity" property="passport_doc" />
                        @endif
                    </div>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Driver's License No.</span>
                    <div class="text-right">
                        <span>{{ $therapist->identity->drv_license_no }}</span><br>
                        @if (not_null($therapist->identity->drv_license_no))
                            <livewire:download-doc-button :obj="$therapist->identity" property="drv_license_doc" />
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div> Practitioner License</div>
                @if ($therapist->profileLog->license)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->profileLog->license)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Academic Title</span>
                    <span>{{ $therapist->license->academic_title }}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Experienced In</span>
                    <span>{{ $therapist->license->experience }}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Experience</span>
                    <span>{{ $therapist->experienceYearsHCol }} Years</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">License Type</span>
                    <span>{{ $therapist->license->type }}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">License #</span>
                    <div class="text-right">
                        <span>{{ $therapist->license->reference }}</span><br>
                        @if (not_null($therapist->license->license_doc))
                            <livewire:download-doc-button :obj="$therapist->license" property="license_doc" />
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div> Specialities</div>
                @if ($therapist->specialisms != null && $therapist->specialisms->count() > 0)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->specialisms != null && $therapist->specialisms->count() > 0)
                <div class="list-group-item list-group-item-action">
                    <p class="p-0 m-0">
                        @foreach ($therapist->specialisms as $specialism)
                            <span
                                class="badge badge-subtle badge-primary badge-lg mr-2 mb-2">{{ $specialism->name }}</span>
                        @endforeach
                    </p>
                </div>
            @endif
        </div>
    </div>
    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div> Languages</div>
                @if ($therapist->languages != null && $therapist->languages->count() > 0)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->languages != null && $therapist->languages->count() > 0)
                <div class="list-group-item list-group-item-action">
                    <p class="p-0 m-0">
                        @foreach ($therapist->languages as $language)
                            <span
                                class="badge badge-subtle badge-primary badge-lg mr-2 mb-2">{{ $language->name }}</span>
                        @endforeach
                    </p>
                </div>
            @endif
        </div>
    </div>

    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div> Working Hours</div>
                @if ($therapist->profileLog->roster)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->profileLog->roster)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Open</span>
                    <span>{{ $therapist->roster->open }}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Close</span>
                    <span>{{ $therapist->roster->close }}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Appointment Duration</span>
                    <span>{{ $therapist->roster->durationHours() }} Hrs.</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Break </span>
                    <span>{{ $therapist->roster->break }} Mins.</span>
                </div>
            @endif
        </div>
    </div>

    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div>Active Days</div>
                @if ($therapist->profileLog->sessions)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->profileLog->sessions)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Monday</span>
                    <span>
                        @if ($therapist->roster->monday)
                            <span class="mdi mdi-check text-success"></span> Active
                        @else
                            <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                        @endif
                    </span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Tuesday</span>
                    <span>
                        @if ($therapist->roster->tuesday)
                            <span class="mdi mdi-check text-success"></span> Active
                        @else
                            <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                        @endif
                    </span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Wednesday</span>
                    <span>
                        @if ($therapist->roster->wednesday)
                            <span class="mdi mdi-check text-success"></span> Active
                        @else
                            <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                        @endif
                    </span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Thursday</span>
                    <span>
                        @if ($therapist->roster->thursday)
                            <span class="mdi mdi-check text-success"></span> Active
                        @else
                            <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                        @endif
                    </span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Friday</span>
                    <span>
                        @if ($therapist->roster->friday)
                            <span class="mdi mdi-check text-success"></span> Active
                        @else
                            <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                        @endif
                    </span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Saturday</span>
                    <span>
                        @if ($therapist->roster->saturday)
                            <span class="mdi mdi-check text-success"></span> Active
                        @else
                            <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                        @endif
                    </span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Sundary</span>
                    <span>
                        @if ($therapist->roster->sunday)
                            <span class="mdi mdi-check text-success"></span> Active
                        @else
                            <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                        @endif
                    </span>
                </div>
            @endif
        </div>
    </div>

    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div>Pricing</div>
                @if ($therapist->profileLog->pricing)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->profileLog->pricing)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Hourly Rate</span>
                    <span>${{ $therapist->pricing->fee * 100 }}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Session Fee</span>
                    <span><span class="text-muted">${{ (int) $therapist->pricing->fee }} x
                            {{ $therapist->roster->durationHours() }} Hrs. = </span>
                        ${{ $therapist->pricing->therapyFeeUSD() }}</span>
                </div>
            @endif
        </div>
    </div>

    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div>Payment Setup</div>
                @if ($therapist->profileLog->payment)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->profileLog->payment)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Stripe Account</span>
                    <span>{{ $therapist->stripe_acc_id }}</span>
                </div>
            @endif
        </div>
    </div>

    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div>Education</div>
                @if ($therapist->educations != null && $therapist->educations->count() > 0)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->educations != null && $therapist->educations->count() > 0)
                <div
                    class="list-group-item list-group-item-action  align-items-center text-muted small">
                    <span class="w-25">Degree</span>
                    <span class="w-25">Specialization</span>
                    <span class="w-25">Institute</span>
                    <span class="w-25 text-right">Year</span>
                </div>
                @foreach ($therapist->educations as $education)
                    <div
                        class="list-group-item list-group-item-action  align-items-center small">
                        <span class="w-25">{{ $education->degree }}</span>
                        <span class="w-25">{{ $education->specialization }}</span>
                        <span class="w-25">{{ $education->institute }}</span>
                        <span class="w-25 text-right">{{ $education->year }}</span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="card card-fluid">
        <div class="list-group list-group-flush list-group-bordered">
            <li class="list-group-header">
                <div>Experience</div>
                @if ($therapist->experiences != null && $therapist->experiences->count() > 0)
                    <span class="mdi mdi-check-circle mdi-18 text-success ml-1"></span>
                @else
                    <span class="mdi mdi-close-circle mdi-18 text-danger ml-1"></span>
                @endif
            </li>
            @if ($therapist->experiences != null && $therapist->experiences->count() > 0)
                <div
                    class="list-group-item list-group-item-action  align-items-center text-muted small">
                    <span class="w-25">Designation</span>
                    <span class="w-25">Start Year</span>
                    <span class="w-25">End Year</span>
                    <span class="w-25 text-right">Institute/Location</span>
                </div>
                @foreach ($therapist->experiences as $experience)
                    <div
                        class="list-group-item list-group-item-action  align-items-center small">
                        <span class="w-25">{{ $experience->designation }}</span>
                        <span class="w-25">{{ $experience->start }}</span>
                        <span class="w-25">{{ $experience->end }}</span>
                        <span class="w-25 text-right">{{ $experience->location }}</span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            $("#nav-item-admin-therapists").addClass("active");
        })

    </script>
</div>
