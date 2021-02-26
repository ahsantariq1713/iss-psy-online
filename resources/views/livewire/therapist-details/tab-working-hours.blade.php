<div class="tab-pane fade" id="working-hours" role="tabpanel" aria-labelledby="client-billing-contact-tab">

    <div class="card">
        <div class="card-header pb-0 bg-light">
            <h2 id="client-billing-contact-tab m-0" class="card-title">Appointment Settings</h2>
        </div>
        <div class="card-body" style="padding:0px 10px!important">
            <!-- start working -->
            <div class="row py-2">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Start Working At</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->roster->open}} <span class="text-muted">({{$therapist->timezone}})</span>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
            <!-- closes at -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Closes At</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->roster->close}} <span class="text-muted">({{$therapist->timezone}})</span>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
            <!-- appoint duration -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Appointment Duration</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->roster->durationHours()}} Hrs.</span>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
            <!-- break -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Break</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->roster->break}} Mins.</span>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header pb-0 bg-light">
            <h2 id="client-billing-contact-tab m-0" class="card-title">Active Days</h2>
        </div>
        <div class="card-body" style="padding:0px 10px!important">
            <!-- monday -->
            <div class="row py-2">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Monday</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @if($therapist->roster->monday)
                    <span class="mdi mdi-check text-success"></span> Active
                    @else
                    <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                    @endif
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
            <!-- tuesday -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Tuesday</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @if($therapist->roster->tuesday)
                    <span class="mdi mdi-check text-success"></span> Active
                    @else
                    <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                    @endif
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
              <!-- wednesday -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Wednesday</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @if($therapist->roster->wednesday)
                    <span class="mdi mdi-check text-success"></span> Active
                    @else
                    <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                    @endif
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
              <!-- thursday -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Thursday</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @if($therapist->roster->thursday)
                    <span class="mdi mdi-check text-success"></span> Active
                    @else
                    <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                    @endif
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
              <!-- friday -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Friday</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @if($therapist->roster->friday)
                    <span class="mdi mdi-check text-success"></span> Active
                    @else
                    <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                    @endif
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
              <!-- saturday -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Saturday</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @if($therapist->roster->saturday)
                    <span class="mdi mdi-check text-success"></span> Active
                    @else
                    <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                    @endif
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
              <!-- sunday -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Sunday</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @if($therapist->roster->sunday)
                    <span class="mdi mdi-check text-success"></span> Active
                    @else
                    <span class="text-muted"> <span class="mdi mdi-close text-muted"></span> Break</span>
                    @endif
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
        </div>
    </div>
</div>
