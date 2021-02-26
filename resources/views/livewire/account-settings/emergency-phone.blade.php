<div class="card shadow-none border">
    <div class="d-flex justify-content-between p-4">
        <div class="left">
            <h5 class="font-weight-normal">Emergency Contact</h5>
            <p class="text-muted">In any case of emergency, We will use this contact for you.</p>
        </div>
        <div class="right d-lg-block d-md-block d-none">
            <img src="{{asset('assets/images/undraw/undraw_phone_call_grmk.svg')}}" height="120" alt="">
        </div>
    </div>
    <div href="javascript:void(0)" class="d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Phone</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">
                @if(Auth::user()->emergencyPhone)
                {{Auth::user()->emergencyPhone->formattedPhone()}}
                @else
                NA
                @endif
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Relation</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">{{Auth::user()->emergencyPhone->relation ?? 'NA'}}</div>
        </div>
    </div>
    <a href="/setup-emergency-phone" class="cli d-flex justify-content-between border-top px-4 py-3">
        <span class="text-primary font-weight-bold">
            @if(Auth::user()->emergencyPhone) Change @else Setup Contact @endif
        </span>
        <div class="text-muted text-right rem"><i class="fa fa-chevron-right"></i></div>
    </a>
</div>
