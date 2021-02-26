<div class="card shadow-none border">
    <div class="d-flex justify-content-between p-4">
        <div class="left">
            <h5 class="font-weight-normal">Password Settings</h5>
            <p class="text-muted">We recommend you to change your password after every 15 days to keep
                your
                account secure.</p>
        </div>
        <div class="right d-lg-block d-md-block d-none">
            <img src="{{asset('assets/images/undraw/undraw_authentication_fsn5.svg')}}" height="150" alt="">
        </div>
    </div>
    <a href="/change-password" class="cli d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Password</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">{{Auth::user()->whenPasswordChanged()}}</div>
        </div>
        <div class="text-muted text-right rem"><i class="fa fa-chevron-right"></i></div>
    </a>
</div>
