<div class="card shadow-none border">
    <div class="d-flex justify-content-between p-4">
        <div class="left">
            <h5 class="font-weight-normal">Ways that we can verify that it's you</h5>
            <p class="text-muted">These can be used to make sure that it's really you signing in or to
                contact you if there's suspicious activity in your account.</p>
        </div>
        <div class="right d-lg-block d-md-block d-none">
            <img src="{{asset('assets/images/undraw/undraw_two_factor_authentication_namy (1).svg')}}" height="120"
                alt="">
        </div>
    </div>
    <a href="/setup-phone?back=/account-settings" class="cli d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Phone</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">
                @if(not_null(Auth::user()->phone_verified_at)) <i class="fa fa-check-circle-o text-success"></i>@endif
                {{not_null(Auth::user()->phone) ? Auth::user()->phone : 'NA'}}</div>
        </div>
        <div class="text-muted text-right rem"><i class="fa fa-chevron-right"></i></div>
    </a>
    <a href="/setup-email?back=/account-settings" class="cli d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Email</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">
                @if(not_null(Auth::user()->email_verified_at)) <i class="fa fa-check-circle-o text-success"></i>@endif
                {{Auth::user()->email}}
            </div>
        </div>
        <div class="text-muted text-right rem"><i class="fa fa-chevron-right"></i></div>
    </a>
</div>
