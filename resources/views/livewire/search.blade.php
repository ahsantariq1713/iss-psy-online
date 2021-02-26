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
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center text-sm-left">{{$total}} Therapists found to help you</h5>
                    <p class="text-center text-sm-left"> Smart search helps your to find the best therapists for
                        you. </p>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    @forelse($therapists as $therapist)
                    <div class="card">
                        <div class="row">
                            <div class="col-12 col-md-5 col-lg-5 py-4 pr-0 border-right">
                                <section class="px-3 d-flex justify-content-between">
                                    <div>
                                        <p class="text-muted m-0" style="font-size:12px">Hourly Fee</p>
                                        <span
                                            class="h2 font-weight-border pl-1 text-primary">${{(int)$therapist->pricing->fee}}</span>
                                    </div>
                                    <div class="h3 font-weight-normal text-right">
                                        <p class="text-muted m-0" style="font-size:12px">Rating</p>
                                        <i class="mdi mdi-star text-warning"></i><span
                                            class="text-muted">{{$therapist->rating()}}</span>
                                    </div>
                                </section>
                                @php
                                $available = $therapist->getBookingCalendar($visitortz)['available'];
                                @endphp
                                <section class="px-1 mt-3 text-center pb-6 mb-3">
                                    <img src="{{ asset($therapist['avatar']) }}" class="rounded-circle" height="130"
                                        width="130" alt="">
                                    <h5 class="font-weight-normal mt-3 mb-1">{{$therapist->name}}</h5>
                                    <span class="text-muted">{{$therapist->license->experience}}</span><br>
                                    <span
                                        class="badge badge-subtle badge-{{$available ? 'success' : 'danger'}} px-2 mt-2"
                                        style="border-radius:50px!important">
                                        <span class="mdi mdi-circle small"></span>
                                        {{$available ? ' Available' : 'Unavailable'}}

                                    </span>
                                    <section class="d-flex justify-content-center mt-3">
                                        <span class="badge badge-subtle rounded-circle badge-primary m-0 mr-1">
                                            <span class="material-icons h4 m-0 p-0">
                                                check_circle_outline
                                            </span>
                                        </span>
                                        <span class="badge badge-subtle rounded-circle badge-primary m-0 mr-1">
                                            <span class="material-icons h4 m-0 p-0">
                                                schedule
                                            </span>
                                        </span>
                                        <span class="badge badge-subtle rounded-circle badge-primary m-0">
                                            <span class="material-icons h4 m-0 p-0">
                                                date_range
                                            </span>
                                        </span>
                                    </section>

                                    @if(not_null($therapist->license->video_url))
                                    <iframe class="position-absolute-center"
                                        style="width:200px;height:106px;z-index:9; top:390px;" disabled=""
                                        src="{{$therapist->license->video_url}}">
                                    </iframe>
                                    <div class="position-absolute bg-transparent"
                                        style="z-index:10;cursor: pointer;width:200px;height:106px; top:390px;left:65px"
                                        onclick="loadVideo('{{$therapist->license->video_url}}')">
                                    </div>
                                    @endif
                                </section>
                            </div>
                            <div class="col-12 col-md-7 col-lg-7 pl-0">
                                <section class="border-bottom py-3 pr-3 pl-3 bg-subtle-primary ml-sm-2 ml-md-0 ml-lg-0">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-primary mt-2" style="font-size: 13px">Booked five times in
                                            last 48 hours</span>
                                        @if($available)
                                        @php
                                        $redirect = "/booking-calendar/" . $therapist->id;
                                        $redirect = Auth::check() ? $redirect : '/login?next=' . $redirect;
                                        @endphp
                                        <a class="btn btn-primary" href="{{$redirect}}">Book
                                            Now</a>
                                        @else
                                        <button class="btn btn-primary" disabled>Book Now</button>
                                        @endif
                                    </div>
                                </section>
                                <section class="border-bottom py-4 pl-3 pr-4 ml-sm-2 ml-md-0 ml-lg-0">
                                    <section class="mb-3">

                                        <h6 class="font-weight-normal">About</h6>
                                        <p class="text-muted mb-1" style="font-size: 13px">
                                            {{$therapist->license->about}}</p>
                                        <a href="more-about-therapist/{{$therapist->id}}" class="text-primary mb-0">More
                                            about {{$therapist->name}}</a>
                                    </section>
                                    <div class="d-flex justify-content-start">
                                        <i class="mdi mdi-clock-outline mr-2 lead"></i>
                                        <span class="mt-1">
                                            {{$therapist->roster->openReadable($visitortz)}}
                                            -
                                            {{$therapist->roster->closeReadable($visitortz)}}
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <span class="mdi mdi-briefcase-outline lead"></span>
                                        <span class="mt-1 ml-2"> {{$therapist->experienceYears()}} Years
                                            Experience</span>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <i class="mdi mdi-video-outline mr-2 lead"></i>
                                        <span class="mt-1"> {{$therapist->roster->durationHours()}} Hour Video
                                            Consultation</span>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <i class="mdi mdi-map-marker-outline mr-2 lead"></i>
                                        <span class="mt-1" style="font-size:14px;color:black">
                                            {{$therapist->country}}</span>
                                    </div>
                                </section>
                                <section class="py-4 pl-3 pr-4">
                                    <h6 class="font-weight-normal">Specialities</h6>
                                    @foreach($therapist->specialisms as $specialism)
                                    <span
                                        class="badge badge-sm mb-1 badge-{{collect($specialisms)->contains($specialism->id) ? 'primary badge-subtle' : 'light'}} mr-1 py-2 rounded-0"
                                        style="border-radius: 50px">{{$specialism->name}}</span>
                                    @endforeach
                                </section>
                                <section class="py-4 pl-3 pr-4">
                                    <h6 class="font-weight-normal">Languages</h6>
                                    @foreach($therapist->languages as $language)
                                    <span
                                        class="badge badge-sm mb-1 badge-{{collect($languages)->contains($language->id) ? 'primary badge-subtle' : 'light'}} mr-1 py-2 rounded-0"
                                        style="border-radius: 50px">{{$language->name}}</span>
                                    @endforeach
                                </section>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div id="notfound-state" class="empty-state">
                        <!-- .empty-state-container -->
                        <div class="empty-state-container">
                            <div class="state-figure">
                                <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}"
                                    alt="" style="max-width: 300px">
                            </div>
                            <h3 class="state-header"> No Content, Yet. </h3>
                            <p class="state-description lead text-muted"> No resources found to show. Add some new
                                content or visit again to see if content is available. </p>
                        </div>
                    </div>
                    @endforelse
                    @if(not_null($therapists) && $therapists->count() > 0)
                    <div class="mt-2 text-right mb-3">
                        <button class="btn btn-primary" {{$prev ? '' : 'disabled'}} wire:click="showPrev"
                            wire:loading.attr="disabled">
                            <span class="mdi mdi-arrow-left"></span>
                            Previous Page
                        </button>
                        <button class="btn btn-primary" {{$next ? '' : 'disabled'}} wire:click="showNext"
                            wire:loading.attr="disabled">
                            Next Page
                            <span class="mdi mdi-arrow-right"></span>
                        </button>
                    </div>
                    @endif
                </div>

                <div class="col-12 col-md-12 col-lg-4">
                    @include('livewire.search-filter')
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade bd-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog" id="video-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg mt-5">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header p-0">
                    <iframe id="video-frame" class="w-100" style="min-height:500px;border:0px" src="">
                    </iframe>
                    <button id="close-btn" type="button" class="btn btn-icon bg-light ml-2" data-dismiss="modal"
                        aria-label="Close" style="margin-top:-20px;margin-right:-15px">
                        <span class="mdi mdi-close lead"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function loadVideo(url) {
            document.getElementById('video-frame').setAttribute('src', url);
            $('#video-modal').modal('show');
        }

        document.addEventListener('livewire:load', function () {
            $("#video-modal").on("hidden.bs.modal", function () {
                $('#video-frame').attr('src', null);
            });
        });
    </script>
    <div wire:ignore>
        @include('partials.global.country-region-injector')
    </div>
</div>
