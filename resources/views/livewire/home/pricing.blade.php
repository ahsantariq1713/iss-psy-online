<section class="position-relative py-5 bg-light" id="pricing">

    <div class="sticker">
        <div class="sticker-item sticker-top-right sticker-soften translate-x-50">
            <img src="{{ asset('assets/images/site/bubble1.svg') }}" alt="" data-aos="fade-left">
        </div>
    </div>

    <div class="container position-relative">
        <h2 class="text-center"> Simple pricing </h2>
        <p class="lead text-muted text-center mb-5"> Connecting therapists worldwide at affordable rates! </p>

        <div class="row align-items-center">
            <div class="col-12 col-md-5 offset-md-1 py-md-4 pr-md-0">
                <div class="card font-size-lg shadow-lg" data-aos="fade-up">
                    <h5 class="card-header text-center text-success p-4 px-lg-5"> For Clients (Patients) </h5>
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="display-3 text-center">
                            <sup><small>$</small></sup>0<small><small style="font-size:16px">Booking Fee</small></small>
                        </h4>
                        <p class="text-center text-muted mb-5">You will not be charged unless you book an appointment.
                        </p>
                        <ul class="list-icons">
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span> Free
                                Signup
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span> Free
                                Video/Audio calling service included
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span> Free
                                Clinical reports sharing
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span> Free
                                Appointment reminders
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span> No
                                hidden fees or membership
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span> 24/7
                                customer support
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span>
                                Secure payments
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="/register" class="card-footer-item p-4 px-lg-5 text-success">Create Account</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-5 py-md-4 pl-md-0">
                <div class="card font-size-lg card-inverse bg-success shadow" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="card-header text-center p-4 px-lg-5"> For Therapists </h5>
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="display-3 text-center">
                            <sup><small>%</small></sup>{{ env('PLATFORM_COMMISSION') }}<small><small
                                    style="font-size:16px">session
                                    fee</small></small>
                        </h3>
                        <p class="text-center text-muted-light mb-5"> You will be charged a
                            {{ env('PLATFORM_COMMISSION') }}% service fee only when an
                            appointment is booked.
                        </p>
                        <ul class="list-icons">
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span>
                                FreeSignup
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span>
                                Video/Audio calling service included
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span>
                                Custom clinical reports storage/sharing
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span>
                                Appointment reminders
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span>
                                Patient reports handling
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span>
                                Financial reports
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span> 24/7
                                customer support
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span>
                                Secure payments
                            </li>
                            <li class="mb-2 pl-1">
                                <span class="list-icon"><img class="mr-2"
                                        src="{{ asset('assets/images/site/check.svg') }}" alt="" width="16"></span> No
                                hidden charges or membership
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="/register" class="card-footer-item text-white p-4 px-lg-5">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
