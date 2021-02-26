<section class="py-5 position-relative bg-light">
    <div class="sticker">
        <div class="sticker-item sticker-bottom-left w-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="120" viewbox="0 0 1440 240"
                preserveaspectratio="none">
                <path class="fill-black" fill-rule="evenodd"
                    d="M1070.39 25.041c107.898 11.22 244.461 20.779 369.477 51.164L1440 240H0L.133 72.135C350.236-17.816 721.61-11.228 1070.391 25.04z">
                </path>
            </svg>
        </div>
    </div>
    <div class="container">
        <div class="card bg-subtle-success text-white position-relative overflow-hidden shadow rounded-lg p-4 mb-0"
            data-aos="fade-up">
            <div class="sticker">
                <div class="sticker-item sticker-middle-left">
                    <img class="flip-y" style="margin-left:-40px;margin-top:5px" src="{{ asset('assets/images/site/bubble4_purple.png') }}" alt="">
                </div>
            </div>
            <div class="card-body d-md-flex justify-content-between align-items-center text-center position-relative">
                <h3 class="font-weight-normal mb-3 mb-md-0 mr-md-3"> Are you a THERAPIST? </h3>
                <a class="btn btn-lg btn-primary shadow" href="/register">Create Account<i
                        class="fa fa-angle-right ml-2"></i></a>
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-black text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-4">
                <img src="{{ asset('assets/images/logo-inverse.png') }}" class="mb-3" alt="">
                <br>
                <a href="mailto:support@psychologists-online.com" class="text-info">
                    <span class="font-weight-bold">
                        Email:
                        <span class="text-white mb-4 mt-0"> support@psychologists-online.com</span>
                    </span>
                </a>
                <br>
                <br>
                <ul class="list-inline mb-5 mb-md-0">
                    <li class="list-inline-item mr-3" data-aos="fade-in" data-aos-delay="100">
                        <a href="https://www.instagram.com/psychologists_online" target="_blank"
                            class="text-muted text-decoration-none" title="instagram">
                            <img class="grayscale" src="{{asset('assets/images/site/instagram.svg')}}" alt=""
                                width="24">
                        </a>
                    </li>
                    <li class="list-inline-item mr-3" data-aos="fade-in" data-aos-delay="200">
                        <a href="https://www.linkedin.com/in/psychologists-online-261b861bb" target="_blank"
                            class="text-muted text-decoration-none" title="linkedin">
                            <img class="grayscale" src="{{asset('assets/images/site/linkedin.svg')}}" alt="" width="24">
                        </a>
                    </li>
                    <li class="list-inline-item mr-3" data-aos="fade-in" data-aos-delay="300">
                        <a href="https://www.facebook.com/Psychologists-Onlinecom-101896605058586" target="_blank"
                            class="text-muted text-decoration-none" title="facebook">
                            <img class="grayscale" src="{{asset('assets/images/site/facebook.svg')}}" alt="" width="24">
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-6 col-md-3 col-lg-2 mb-3 mb-md-0">
                <h6 class="mb-4"> Company </h6>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="/about-us" class="text-muted">About Us</a>
                    </li>
                    <li class="mb-3">
                        <a href="/faqs" class="text-muted">FAQ's</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-muted">Knowledge Base</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-muted">Press</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-3 col-lg-2 mb-3 mb-md-0">
                <h6 class="mb-4"> Legal </h6>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="/privacy-policy" class="text-muted">Privacy Policy</a>
                    </li>
                    <li class="mb-3">
                        <a href="/terms-of-service" class="text-muted">Terms of Service</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-muted">Cookies Policy</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-3 col-lg-3 mb-3 mb-md-0 offset-lg-1">
                <h6 class="mb-4 lg-text-right"> Language & Region </h6>
                <ul class="list-unstyled">
                    <li class="mb-3 lg-text-right">
                        @include('partials.global.languages')
                    </li>
                </ul>
            </div>
        </div>
        <p class="text-muted text-center mt-5"> © 2020 Psychologists Onlince, Inc. All rights reserved. </p>
    </div>
</section>
