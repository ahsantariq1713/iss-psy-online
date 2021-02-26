<div>
    <header class="page-title-bar mt-3">
        <div class="row text-center text-sm-left">
            <div class="col-sm-auto col-12 mb-2">
                <div class="has-badge has-badge-bottom">
                    <img src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle" height="90" width="90"/>
                </div>
            </div>
            <div class="col">
                <h1 class="page-title"> {{Auth::user()->name}} </h1>
                <p class="mb-0">{{Auth::user()->email}}</p>
                <p class="text-muted">{{Auth::user()->country}} - {{Auth::user()->timezone}}</p>
            </div>
        </div>
        <div class="nav-scroller border-bottom ">
            <div class="nav nav-tabs">
                <a class="nav-link" href="/dashboard">Overview</a>
                <!-- recommendations only for clients and therapists -->
                @if(not(Auth::user()->isAdmin()))
                    <a class="nav-link active" href="/recommendations">Recommendations</a>
                @endif
            </div>
        </div>
    </header>
    <div class="page-section">

        @if($user->isTherapist())
            @include('livewire.recommendations.therapist')
        @elseif($user->isClient())
            @include('livewire.recommendations.client')
        @endif
    </div>
</div>
