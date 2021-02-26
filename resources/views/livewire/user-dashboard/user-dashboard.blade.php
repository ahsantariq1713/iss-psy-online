<div>
    <header class="page-title-bar mt-3">
        <div class="row text-center text-sm-left">
            <div class="col-sm-auto col-12 mb-2">
                <div class="has-badge has-badge-bottom">
                    <img src="{{ asset("$user->avatar") }}" class="rounded-circle" height="90" width="90" />
                </div>
            </div>
            <div class="col">
                <h1 class="page-title"> {{$user->name}} </h1>
                <p class="mb-0">{{$user->email}}</p>
                <p class="text-muted">{{$user->country}} - {{$user->timezone}}</p>
            </div>
        </div>
        <div class="nav-scroller border-bottom ">
            <div class="nav nav-tabs">
                <a class="nav-link active" href="{{ route('dashboard') }}">Overview</a>
                @if($user->isTherapist())
                <a class="nav-link" href="{{ route('therapist.recommendations') }}">Recommendations</a>
                @endif
            </div>
        </div>
    </header>
    <div class="page-section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4">
                <!-- profile progress for clients and therapists -->
                @include('livewire.user-dashboard.profile-progress')
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                @if($user->isTherapist())
                <!-- pro profile verification alert only for therapist -->
                @include('livewire.user-dashboard.pro-profile-verification-alert')
                @endif
                <div class="row mb-4">
                    <div class="col">
                        <a href="{{ route('appointments') }}" class="text-decoration-none text-dark">
                            <div class="metric metric-bordered bg-white">
                                <h2 class="metric-label"> Pending Appointments </h2>
                                <p class="metric-value h1">
                                    @if(Auth::user()->isTherapist())
                                    <span
                                        class="value">{{$user->therapistAppointments->where('status' , 'Pending')->count()}}</span>
                                    @else
                                    <span
                                        class="value">{{$user->clientAppointments->where('status' , 'Pending')->count()}}</span>
                                    @endif
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('appointments') }}" class="text-decoration-none text-dark">
                            <div class="metric metric-bordered bg-white">
                                <h2 class="metric-label"> Active Appointments </h2>
                                <p class="metric-value h1">
                                    @if(Auth::user()->isTherapist())
                                    <span
                                        class="value">{{$user->therapistAppointments->where('status' , 'Active')->count()}}</span>
                                    @else
                                    <span
                                        class="value">{{$user->clientAppointments->where('status' , 'Active')->count()}}</span>
                                    @endif
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <div class="metric metric-bordered bg-white">
                            <h2 class="metric-label">
                                @if(Auth::user()->isTherapist())
                                Earnings
                                @else
                                Spendings
                                @endif
                            </h2>
                            <p class="metric-value h1">
                                <sup>$</sup> <span class="value">
                                    @if(Auth::user()->isTherapist())
                                    <span
                                        class="value">{{$user->therapistAppointments->where('status' , 'Completed')->sum('amount')}}</span>
                                    @else
                                    <span
                                        class="value">{{$user->clientAppointments->where('status' , 'Completed')->sum('amount')}}</span>
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                @php
                $roleKey = strtolower(Auth::user()->role) . '_id';
                $nextAppointment = \App\Models\Appointment::where($roleKey, Auth::id())
                ->where('status', 'Pending')->orderBy('start_date','desc')
                ->first();
                @endphp
                <div class="card">
                    @if(is_null($nextAppointment))
                    <div id="notfound-state" class="empty-state">
                        <!-- .empty-state-container -->
                        <div class="empty-state-container">
                            <div class="state-figure">
                                <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}"
                                    alt="" style="max-width: 200px">
                            </div>
                            <h6 class="state-header"> No Pending Appointment, Yet. </h6>
                            @if(Auth::user()->isClient())
                            <a class="btn btn-primary" href="/search">Book Now</a>
                            @endif
                        </div>
                    </div>
                    @else

                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="metric-label"> Next Appointment </h2>
                            <div class="dropdown">
                                <button type="button" class="btn btn-icon btn-light" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    <div class="dropdown-arrow"></div>
                                    <a href="{{route('appointment-show', [$nextAppointment->id])}}"
                                        class="dropdown-item">Show Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{asset($nextAppointment->participant()->avatar)}}" height="100" width="100"
                            class="rounded-circle mb-2" alt="">
                        <h5 class="card-title">
                            <a href="javascript:void(0)">{{$nextAppointment->participant()->name}}</a>
                        </h5>
                        <p class="card-subtitle text-muted">
                            {{Auth::user()->isClient() ? $nextAppointment->participant()->license->experience : 'Client'}}
                        </p>
                        <h4 class="mt-3">
                            {{$nextAppointment->start_date->setTimeZone(Auth::user()->timezone)->calendar()}}</h4>
                        <a href="{{$nextAppointment->meetingUrl()}}"
                            class="btn btn-primary mb-4 mt-3 {{$nextAppointment->meetingAllowed() ? '' : 'disabled'}}">Start
                            Meeting</a>
                    </div>
                    <div class="progress progress-xs" data-toggle="tooltip" title="" data-original-title="100%">
                        <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="2181" aria-valuemin="0"
                            aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function (){
            $("#nav-item-dashboard").addClass("active");
        })
    </script>
</div>
