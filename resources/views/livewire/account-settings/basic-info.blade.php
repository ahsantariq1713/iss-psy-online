<div class="card shadow-none border">
    <div class="d-flex justify-content-between p-4">
        <div class="left">
            <h5 class="font-weight-normal">Basic Info</h5>
            <p class="text-muted">Some info may be visible to other people using our services.</p>
        </div>
        <div class="right d-lg-block d-md-block d-none">
            <img src="{{ asset('assets/images/undraw/undraw_Detailed_information_re_qmuc.svg') }}" height="120" alt="">
        </div>
    </div>
    <div class="d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Name</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">{{Auth::user()->name}}</div>
        </div>
    </div>
    <div class="d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Birthday</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">{{Auth::user()->birthday()}}</div>
        </div>
    </div>
    <div class="d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Gender</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">{{Auth::user()->gender ?? 'NA'}}</div>
        </div>
    </div>
    <div class="d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-50">
            <div class="col rem">Role</div>
            <div class="col rem text-muted">{{Auth::user()->role}}</div>
        </div>
    </div>
    <a href="/setup-basic-info?back=/account-settings" class="cli d-flex justify-content-between border-top px-4 py-3">
        <span class="text-primary font-weight-bold">Update</span>
        <div class="text-muted text-right rem"><i class="fa fa-chevron-right"></i></div>
    </a>
</div>
