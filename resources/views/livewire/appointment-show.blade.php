<div>
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="/dashboard"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Dashboard</a>
                </li>
            </ol>
        </nav>
        <h1 class="page-title mr-sm-auto">
            Appointment Details
        </h1>
    </header>
    <div class="border-bottom d-flex justify-content-center">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link show active" data-toggle="tab" href="#overview">Overview</a>
            </li>
            @if(not(Auth::user()->isTherapist()))
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#therapist">Therapist</a>
                </li>
            @endif
            @if(not(Auth::user()->isClient()))
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#client">Client</a>
                </li>
            @endif
            @if(not($appointment->isPending()))
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#recommendations">Recommendations</a>
                </li>
                @if(Auth::user()->isTherapist())
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#notes">Private Notes</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#files">Files</a>
                </li>
            @endif
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="tab-content pt-5">
                <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="client-billing-contact-tab">
                    <div class="card card-fluid">
                        <div class="list-group list-group-flush list-group-bordered">
                            <div class="list-group-item  d-flex justify-content-between align-items-center">
                                <h2 id="client-billing-contact-tab" class="card-title mb-0 pb-0"> Appointment # {{$appointment->id}} </h2>
                            </div>
                            @if($appointment->meetingAllowed() && not(Auth::user()->isAdmin()) && not($appointment->isCompleted()))
                                <div class="list-group-item d-flex justify-content-between align-items-center p-0">
                                    <div class="alert alert-secondary p-3 m-0 rounded-0 border-0 shadow-none w-100">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Join Meeting</h6>
                                                <p class="m-0">Click to connect to the participant.</p>
                                            </div>
                                            <a class="btn btn-sm btn-success mt-2 d-lg-block d-md-block d-none"
                                               href="{{route('attend-meeting', ['id' => $appointment->id, 'token'=> $appointment->accessToken()])}}"
                                               style="min-width:120px">
                                                Connect
                                            </a>
                                        </div>
                                        <a class="btn btn-sm btn-success mt-2 d-lg-none d-md-none"
                                           href="{{route('attend-meeting', ['id' => $appointment->id,'token'=> $appointment->accessToken()])}}"
                                           style="min-width:120px">
                                            Join Meeting
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <li class="list-group-header">Booking Details</li>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Date</span>
                                <span>{{$appointment->created_at->setTimeZone(Auth::user()->timezone)->format('d-M-Y  h:i A')}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Amount</span>
                                <span>${{$appointment->amount}}</span>
                            </div>
                            @if(Auth::user()->isAdmin())
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Platform Fee</span>
                                    <span>${{$appointment->platform_fee}}</span>
                                </div>
                            @endif
                            <li class="list-group-header">Meeting Details</li>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Date</span>
                                <span>{{$appointment->start_date->setTimeZone(Auth::user()->timezone)->format('d-M-Y')}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Start Time</span>
                                <span>{{$appointment->start_date->setTimeZone(Auth::user()->timezone)->format('h:i A')}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">End Time</span>
                                <span>{{$appointment->end_date->setTimeZone(Auth::user()->timezone)->format('h:i A')}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Status</span>
                                @if($appointment->status == 'Pending')
                                    <span class="badge badge-info">{{$appointment->status}}</span>
                                @elseif($appointment->status == 'Completed')
                                    <span class="badge badge-success">{{$appointment->status}}</span>
                                @elseif($appointment->status == 'Cancelled')
                                    <span class="badge badge-danger">{{$appointment->status}}</span>
                                @else
                                    <span class="badge badge-warning">{{$appointment->status}}</span>
                                @endif
                            </div>
                            @if(Auth::user()->isAdmin())
                                <li class="list-group-header">Participants Attendance</li>
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Therapist Attended</span>
                                    @if(not_null($appointment->therapist_attended_at))
                                        <span>{{$appointment->therapist_attended_at->setTimeZone(Auth::user()->timezone)->format('d-M-Y h:i A')}}</span>
                                    @else
                                        <span>NA</span>
                                    @endif
                                </div>
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Client Attended</span>
                                    @if(not_null($appointment->client_attended_at))
                                        <span>{{$appointment->client_attended_at->setTimeZone(Auth::user()->timezone)->format('d-M-Y h:i A')}}</span>
                                    @else
                                        <span>NA</span>
                                    @endif
                                </div>
                            @endif
                            <li class="list-group-header">Client Feedback</li>
                            @if($appointment->requiresFeedback() && Auth::user()->isClient())
                                <div class="list-group-item  d-flex justify-content-between align-items-center">
                                    <textarea class="form-control" placeholder="Leave your comment (optional)" rows="5" wire:model.defer="feedback"></textarea>
                                </div>
                                <div class="list-group-item  d-flex justify-content-between align-items-center border-0">
                                    <span class="text-muted">Review</span>
                                    <span class="rating">
                                        <input type="radio" name="rating2" id="ratingr5" value="5" wire:model="stars"> <label for="ratingr5"><span class="fa
                                        fa-star"></span></label>
                                        <input type="radio" name="rating2" id="ratingr4" value="4" wire:model="stars"> <label for="ratingr4"><span class="fa
                                        fa-star"></span></label>
                                        <input type="radio" name="rating2" id="ratingr3" value="3" wire:model="stars"> <label for="ratingr3"><span class="fa
                                        fa-star"></span></label>
                                        <input type="radio" name="rating2" id="ratingr2" value="2" wire:model="stars"> <label for="ratingr2"><span class="fa
                                        fa-star"></span></label>
                                        <input type="radio" name="rating2" id="ratingr1" value="1" wire:model="stars"> <label for="ratingr1"><span class="fa
                                        fa-star"></span></label>
                                    </span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                                    <span class="text-muted"></span>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-success btn-sm" {{is_null($stars) ? 'disabled' : ''}} wire:click="postFeeback"
                                                wire:loading.attr="disabled">
                                            <span class="spinner-border spinner-border-sm mr-2" wire:loading.delay></span>
                                            Post Feedback
                                        </button>
                                    </div>
                                </div>
                            @else

                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="m-0">
                                        {{$appointment->feedback}}
                                    </span>
                                </div>
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0">
                                    <span class="text-muted">Review</span>
                                    @include('partials.global.rating-display', ['rating' => $appointment->stars])
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="therapist" role="tabpanel">
                    <div class="d-flex justify-content-between px-3 py-3">
                        <div>
                            <h2 id="client-billing-contact-tab" class="card-title mb-0 pb-0"> {{$appointment->therapist->name}} </h2>
                            <span class="text-muted">Therapist</span>
                        </div>
                        <img class="rounded-circle" src="{{asset($appointment->therapist->avatar)}}" height="100" width="100" alt="">
                    </div>
                    <div class="card card-fluid">
                        <div class="list-group list-group-flush list-group-bordered">
                            @if(Auth::user()->isAdmin())
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Email</span>
                                    <span>{{$appointment->therapist->email}}</span>
                                </div>
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Phone</span>
                                    <span>{{$appointment->therapist->phone}}</span>
                                </div>
                            @endif
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Gender</span>
                                <span>{{$appointment->therapist->gender}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Birthday</span>
                                <span>{{$appointment->therapist->birthday}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Location</span>
                                <span>{{$appointment->therapist->country}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Time Zone</span>
                                <span>{{$appointment->therapist->timezone}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Rating</span>
                                @include('partials.global.rating-display', ['rating' => $appointment->therapist->rating()])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="client" role="tabpanel">
                    <div class="d-flex justify-content-between px-3 py-3">
                        <div>
                            <h2 id="client-billing-contact-tab" class="card-title mb-0 pb-0"> {{$appointment->client->name}} </h2>
                            <span class="text-muted">Client</span>
                        </div>
                        <img class="rounded-circle" src="{{asset($appointment->client->avatar)}}" height="100" width="100" alt="">
                    </div>
                    <div class="card card-fluid">
                        <div class="list-group list-group-flush list-group-bordered">
                            @if(Auth::user()->isAdmin())
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Email</span>
                                    <span>{{$appointment->client->email}}</span>
                                </div>
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Phone</span>
                                    <span>{{$appointment->client->phone}}</span>
                                </div>
                            @endif
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Gender</span>
                                <span>{{$appointment->client->gender}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Birthday</span>
                                <span>{{$appointment->client->birthday}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Location</span>
                                <span>{{$appointment->client->country}}</span>
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Time Zone</span>
                                <span>{{$appointment->client->timezone}}</span>
                            </div>
                            <li class="list-group-header">Emergency Contact</li>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Phone</span>
                                @if(not_null($appointment->client->emergencyPhone))
                                    <span>{{$appointment->client->emergencyPhone->phone}}</span>
                                @else
                                    <small class="text-muted">Not Available</small>
                                @endif
                            </div>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span class="text-muted">Relation</span>
                                @if(not_null($appointment->client->emergencyPhone))
                                    <span>{{$appointment->client->emergencyPhone->relation}}</span>
                                @else
                                    <small class="text-muted">Not Available</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if(not($appointment->isPending()))
                    <div class="tab-pane fade" id="recommendations" role="tabpanel">
                        @if(Auth::user()->isTherapist() && $appointment->allowUpdateRecommendations())
                            <livewire:appointment-recommendations-save :id="$appointmentId"/>
                        @else
                            @if(strlen($appointment->recommendations) <= 0)
                                <div id="notfound-state" class="empty-state">
                                    <!-- .empty-state-container -->
                                    <div class="empty-state-container">
                                        <div class="state-figure">
                                            <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}" alt="" style="max-width: 300px">
                                        </div>
                                        <h3 class="state-header"> No Content, Yet. </h3>
                                        <p class="state-description lead text-muted"> Recommendation not found to show. </p>
                                    </div>
                                </div>
                            @else
                                <div class="card card-fluid">
                                    <div class="list-group list-group-flush list-group-bordered">
                                        <li class="list-group-header">Recommendations</li>
                                        <div class="list-group-item">
                                            <span class="m-0">{!! $appointment->recommendations !!}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    @if(Auth::user()->isTherapist())
                        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="client-billing-contact-tab">
                            <livewire:appointment-notes-save :id="$appointmentId"/>
                        </div>
                    @endif
                    <div class="tab-pane fade h-100" id="files" role="tabpanel">
                        <livewire:appointment-files-hanlder :appointmentId="$appointment->id"/>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
