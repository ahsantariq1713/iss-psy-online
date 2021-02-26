<div class="card shadow-none border">
    <div class="d-flex justify-content-between p-4">
        <div class="left">
            <h5 class="font-weight-normal">Country & Region</h5>
            <p class="text-muted">Your country and timezone is configured automatically.</p>
        </div>
        <div class="right d-lg-block d-md-block d-none">
            <img src="{{asset('assets/images/undraw/undraw_Around_the_world_re_n353.svg')}}" height="150" alt="">
        </div>
    </div>
    <div class=" d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Country</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">{{Auth::user()->country}}</div>
        </div>
    </div>
    <div class=" d-flex justify-content-between border-top px-4 py-3">
        <div class="row w-75">
            <div class="col rem">Time Zone</div>
            <div class="col-sm-12 col-md-8 col-lg-8 rem text-muted">{{Auth::user()->timezone}}</div>
        </div>
    </div>
</div>
