<div>
    <section class="position-relative" wire:ignore>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100" viewbox="0 0 1440 240"
            preserveaspectratio="none">
            <path class="fill-light" fill-rule="evenodd"
                d="M0 240V0c19.985 5.919 41.14 11.008 63.964 14.89 40.293 6.855 82.585 9.106 125.566 9.106 74.151 0 150.382-6.697 222.166-8.012 13.766-.252 27.51-.39 41.21-.39 99.76 0 197.087 7.326 282.907 31.263C827.843 72.527 860.3 117.25 906.926 157.2c43.505 37.277 115.38 51.186 208.485 53.076 7.584.153 15.156.224 22.714.224 40.887 0 81.402-2.062 121.914-4.125 40.512-2.062 81.027-4.125 121.902-4.125 1.01 0 2.019.002 3.03.004 16.208.042 34.959.792 55.029 2.234V240H0z">
            </path>
        </svg>
    </section>

    {{-- Search Result --}}
    <section class="position-relative pb-5 bg-light">
        <div class="sticker" wire:ignore>
            <div class="sticker-item sticker-top-right sticker-soften">
                <img src="{{ asset('assets/images/site/cubes.svg') }}" alt="" data-aos="zoom-in">
            </div>
            <div class="sticker-item sticker-bottom-left sticker-soften scale-150">
                <img src="{{ asset('assets/images/site/cubes.svg') }}" alt="" data-aos="zoom-in">
            </div>
        </div>
        <div class="container position-relative">
            <div class="card shadow-none border rounded-0 border-right-0 p-0">
                <div class="pt-4 pb-4 text-center  border-right">
                    <img src="{{ asset($therapist['avatar']) }}" alt="" class="rounded-circle" height="120" width="120"
                        style="margin-top:-70px" />
                    <h4 class="m-0 font-weight-normal mt-3"><small>Find a time to meet</small> <br>
                        <strong>{{$therapist['name']}}</strong></h4>
                    <h6 class="m-0 font-weight-normal text-muted"><small>{{$therapist['title']}}</small></h6>
                </div>
                <div class="row m-0 p-0 font-weight-bold bg-primary text-white border-top">
                    @foreach ($calendar['dates'] as $date)
                    <div class="col m-0 py-2 px-1 text-center border-right">
                        {{substr($date['day'],0,3)}}
                    </div>
                    @endforeach
                </div>
                <div class="row m-0 p-0 font-weight-bold">
                    @foreach ($calendar['dates'] as $date)
                    @if($date['available'])
                    <div style="cursor: pointer"
                        class="col border-bottom
                        m-0 py-2 px-1 text-center
                        border-right text-docoration-none {{$selectedDate == $date['id'] ? 'bg-primary text-white' : 'text-black'}}"
                        wire:click='select({{$date['id']}})'>
                        <p class="m-0 lead font-weight-bold">{{$date['date']}}</p>
                        <small class="d-none d-md-block d-lg-block"> {{$date['month']}}</small>
                    </div>
                    @else
                    <div class="col border-bottom m-0 py-2 px-1 text-center border-right text-muted">
                        <p class="m-0 lead font-weight-bold">{{$date['date']}}</p>
                        <small class="d-none d-md-block d-lg-block"> {{$date['month']}}</small>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="p-3 border-right text-center pt-5 py-4" style="min-height:272px!important">
                    <div wire:loading.remove wire:target='select'>
                        @if(count($sessions) > 0 )<p class="text-muted mb-0">avaiable sessions for selected date</p>
                        <h4 class="mb-3 mt-0 font-weight-normal"> {{$readableSelected}}
                        </h4>
                        @foreach ($sessions as $session)
                        <span
                            class="badge p-3 mr-2 mb-2  {{$session['id'] == $selectedSession ? 'badge-primary' : 'badge-light'}}"
                            style="cursor: pointer" wire:click='selectSession("{{$session['id']}}")'>
                            <span class="h6 font-weight-normal">
                                {{\App\Helpers\UserReadable::sessionDate($session['start'],$visitortz)->format('h:i A')}}
                            </span>
                        </span>
                        @endforeach
                        <br>
                        <div class="text-center mt-1" wire:loading.delay wire:target='selectSession'>
                            <span class="spinner-border spinner-border-sm"></span> Please wait ...
                        </div>
                        @if(not_null($selectedSession))
                        <div class="mt-4">
                            <h5 class="font-weight-normal">Booking Summary</h5>
                            <p class="mb-3 text-center text-muted"> You will be redirected to our secure payment
                                endpoint. </p>
                            <div>
                                <span class="lead">
                                    <span class="mdi mdi-calendar-outline lead"></span>
                                    {{\App\Helpers\UserReadable::sessionDate($selectedSessionDetails['start'],$visitortz)->format('d M, Y')}}
                                </span>
                                <span class="ml-2 lead">
                                    <span class="mdi mdi-clock-outline lead"></span>
                                    {{\App\Helpers\UserReadable::sessionDate($selectedSessionDetails['start'],$visitortz)->format('h:i A')}}
                                </span>
                                <span class="ml-2 lead">
                                    <span class="mdi mdi-video-outline lead"></span>
                                    {{$therapist['appointDuration']}} Hr Video Call
                                </span>
                            </div>
                            <div class="metric mb-0">
                                <p class="metric-value h1"> ${{$therapist['fee']}} </p>
                                <h2 class="metric-label"> Consultation Fee</h2>
                            </div>
                        </div>
                        <p class="mt-2">
                            <button wire:click="checkout" wire:loading.attr='disabled' class="btn btn-lg btn-success"
                                {{is_null($selectedSession) ? 'disabled' : ''}}>
                                <span class="spinner-border spinner-border-sm mr-1" wire:loading
                                    wire:target='checkout'></span>
                                Checkout
                                <span class="mdi mdi-arrow-right"></span>
                            </button>
                        </p>
                        @endif
                        @else
                        <p class="text-muted">No session available to book.</p>
                        @endif
                    </div>
                    <!-- loading spinner -->
                    <div class="text-center w-100 h-100 my-auto text-muted">
                        <div wire:loading.delay wire:target='select'>
                            <span class="spinner-border spinner-lg" style="height:72px;width:72px"></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('livewire:load', () => {
            window.livewire.on('triggerStripeCheckout', (payload) => {
                let stripe = Stripe(payload.key);
                stripe.redirectToCheckout({
                    // Make the id field from the Checkout Session creation API response
                    // available to this file, so you can provide it as argument here
                    // instead of the CHECKOUT_SESSION_ID placeholder.
                    sessionId: payload.sessionId,
                }).then(function (result) {
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, display the localized error message to your customer
                    // using `result.error.message`.
                    console.log(result.error.message);
                });
            });
        });
    </script>
    <div wire:ignore>
        @include('partials.global.country-region-injector')
    </div>
</div>
