<nav class="navbar navbar-expand-lg navbar-light py-4" data-aos="fade-in">
    <div class="container">
        <div class="d-flex ">
            <button class="hamburger hamburger-squeeze hamburger-light d-sm-block d-lg-none d-md-block" type="button"
                data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            <a class="navbar-brand float-right  mr-0 mb-2 d-sm-block d-lg-none d-md-block" href="/">
                <img src="{{ asset('assets/images/logo.png') }}" alt="">
            </a>
        </div>
        <div class="d-flex justify-content-end">

            @auth
            <div class="d-sm-block d-lg-none d-md-block">
                @include('partials.global.languages')
            </div>
            <a class="btn btn-subtle-primary ml-2 mr-2 order-lg-2 d-sm-block d-lg-none d-md-block"
                href="/dashboard">Dashboard</a>
            <livewire:logout mode="btn-sm" />
            @else
            <div class="d-sm-block d-lg-none d-md-block">
                @include('partials.global.languages')
            </div>
            <a class="btn btn-subtle-primary ml-2 mr-2 order-lg-2 d-sm-block d-lg-none d-md-block"
                href="/login">Login</a>
            <a class="btn btn-primary mr-2 order-lg-2 d-sm-block d-lg-none d-md-block" href="/register">Register</a>
            @endauth
        </div>

        <a class="navbar-brand ml-auto mr-0 mb-2 d-none d-lg-block" href="/">
            <img src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>

        @auth
        <div class="ml-auto order-lg-2 mr-2 d-none d-lg-block"> @include('partials.global.languages')</div>
        <a class="navbar-btn btn btn-subtle-primary ml-auto order-lg-2 mr-2 d-none d-lg-block"
            href="/dashboard">Dashboard</a>
        <livewire:logout mode="btn-lg" />
        @else
        <div class="ml-auto order-lg-2 mr-2 d-none d-lg-block"> @include('partials.global.languages')</div>
        <a class="navbar-btn btn btn-subtle-primary ml-auto order-lg-2 mr-2 d-none d-lg-block" href="/login">Login</a>
        <a class="navbar-btn btn btn-primary ml-auto order-lg-2 mr-2 d-none d-lg-block" href="/register">Register</a>
        @endauth



        <div class="navbar-collapse collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mr-lg-3" id="landing-nav-home">
                    <a class="nav-link py-2" href="/">Home</a>
                </li>
                <li class=" nav-item mr-lg-3" id="landing-nav-therapists">
                    <a class="nav-link py-2" href="/search">Therapists</a>
                </li>
                <li class="nav-item mr-lg-3" id="landing-nav-pricing">
                    <a class="nav-link py-2" href="#pricing">Pricing</a>
                </li>
                <li class="nav-item mr-lg-3" id="landing-nav-about">
                    <a class="nav-link py-2" href="#testimonials">Testimonials</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
