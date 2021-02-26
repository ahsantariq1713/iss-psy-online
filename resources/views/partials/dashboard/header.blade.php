<header class="app-header app-header-dark">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-lg-0">

        <div class="container">

            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/images/logo-inverse.png') }}" class="" alt="">
            </a>

            <button class="hamburger hamburger-squeeze d-flex d-lg-none" type="button" data-toggle="collapse"
                data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard" id="nav-item-dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/appointments" id="nav-item-appointments">Appointments</a>
                    </li>
                    @if (Auth::user()->isTherapist())
                        <li class="nav-item" id="nav-item-dashboard">
                            <a class="nav-link" href="{{ route('therapist.professional-profile', ['identity']) }}"
                                id="nav-item-proProfile">Professional
                                Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/my-clients" id="nav-item-clients">My
                                Clients</a>
                        </li>
                    @elseif(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="/clients" id="nav-item-clients">
                                Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.therapists') }}" id="nav-item-admin-therapists">Therapists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/admin-portal/therapists?profileStatus=Under Review')}}" id="nav-item-approval-requests">Approval
                                Requests</a>
                        </li>
                    @elseif(Auth::user()->isClient())
                        <li class="nav-item">
                            <a class="nav-link" href="/my-therapists" id="nav-item-myTherapists">My
                                Therapists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/my-spending" id="nav-item-my-spending">Spending</a>
                        </li>
                    @endif
                </ul>

                {{-- <form
                    class="top-bar-search d-lg-inline-block w-auto my-2 my-lg-0 px-0 px-lg-2">
                    --}}
                    {{-- <div class="input-group input-group-search">
                        --}}
                        {{-- <input class="form-control" type="search"
                            placeholder="Search" aria-label="Search">--}}
                        {{-- </div>--}}
                    {{-- </form>--}}

                <!--
                    <ul class="header-nav nav">
                    <livewire:nav-activities />
                    {{--                    @if (not(Auth::user()->isAdmin()))--}}
                    {{--                    <livewire:nav-messages />--}}
                    {{--                    @endif--}}
                    <script type="text/javascript">
                        document.addEventListener('livewire:load', () => {
                            const definite = new Audio("{{ asset('assets/sounds/definite.mp3') }}");
                            window.Echo.channel('user{{ Auth::id() }}')
                                .listen('.refresh.nav', function (event) {
                                    window.livewire.emit('refreshNav');
                                    definite.play();
                                });
                        });
                    </script>
                </ul>
            -->

                <div class="navbar-nav dropdown d-flex mr-lg-n3">
                    <button class="btn-account w-100" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="d-flex justify-content-start">
                            <span class="user-avatar user-avatar-md mr-lg-0">
                                <img src="{{ asset(Auth::user()->avatar) }}" alt=""></span> <span
                                class="account-summary d-lg-none"><span
                                    class="account-name">{{ Auth::user()->name }}</span>
                                <span class="account-description">{{ Auth::user()->role }}</span>
                            </span>
                            {{-- <div class="my-auto">
                                <span class="badge badge-light lead ml-2" style="font-size:16px">$ 0</span>
                            </div> --}}
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-arrow mr-3"></div>
                        <a class="dropdown-item" href="/account-settings">
                            <span class="dropdown-icon oi oi-cog"></span> Account Settings
                        </a>
                        <livewire:logout mode="dropdown" />
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/support-tickets">Support Tickets</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</header>
