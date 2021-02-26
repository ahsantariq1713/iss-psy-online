<div class="card shadow-none border">
    <div class="d-flex justify-content-between p-4">
        <div class="left">
            <h5 class="font-weight-normal">Profile Picture</h5>
            <p class="text-muted">Change your profile picture.</p>
            <img src="{{asset(Auth::user()->avatar)}}" class="rounded-circle" height="100" width="100" alt="">
        </div>
        <div class="right d-lg-block d-md-block d-none">
            <img src="{{asset('assets/images/undraw/undraw_profile_6l1l.svg')}}" height="150" alt="">
        </div>
    </div>
    <a href="/setup-profile-picture?back=/account-settings" class="cli d-flex justify-content-between border-top px-4 py-3">
        <span class="text-primary font-weight-bold">
            Change
        </span>
        <div class="text-muted text-right rem"><i class="fa fa-chevron-right"></i></div>
    </a>
</div>
