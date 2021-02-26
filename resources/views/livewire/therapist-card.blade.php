<div class="card">
    <div class="bg-secondary pt-3 pr-3 pb-5 border-0">
        <div class="d-flex justify-content-end">
            <span class="badge badge-{{$therapist['profileStatus'] == 'Approved' ? 'success' : 'danger'}}">{{$therapist['profileStatus']}}</span>
        </div>
    </div>
    <div class="px-4 pb-4">
        <div class="d-flex justify-content-between">
            <div class="mr-3">
                <img src="{{asset($therapist['avatar'])}}" alt="" class="rounded-circle p-1 bg-white" height="110"
                    width="110" style="margin-top:-50px" />
                <div>
{{--                    <div class="m-0">--}}
{{--                        @include('partials.global.rating-display', ['rating' => $therapist->rating()])--}}
{{--                    </div>--}}
{{--                    <span class="text-muted m-0" style="font-size:13px">Average Rating</span>--}}
                </div>
                <div class="mt-2">
                    <h3 class="m-0">${{(int)$therapist['hourlyRate']}}</h3>
                    <span class="text-muted m-0" style="font-size:13px">Hourly Rate</span>
                </div>
                <div class="mt-2">
                    <h3 class="m-0">{{$therapist['experience_years']}} <span style="font-size:15px">Years</span></h3>
                    <span class="text-muted m-0" style="font-size:13px">Experience</span>
                </div>
            </div>
            <div class="col pl-3 pt-3">
                <h5 class="m-0">{{$therapist['title']}}. {{$therapist['name']}}</h5>
                    <p class="m-0 text-muted mb-3">{{$therapist['experienced_in']}}</p>
                    <div class="d-flex justify-content-start">
                        <i class="mdi mdi-email-outline mr-2 lead"></i>
                        <span class="mt-1"> {{$therapist['email']}}</span>
                    </div>
                    <div class="d-flex justify-content-start">
                        <i class="mdi mdi-clock-outline mr-2 lead"></i>
                        <span class="mt-1"> {{$therapist['roster']['open']}} - {{$therapist['roster']['close']}}</span>
                    </div>
                    <div class="d-flex justify-content-start">
                        <i class="mdi mdi-video-outline mr-2 lead"></i>
                        <span class="mt-1"> {{$therapist['roster']['duration']}} Hour Video Consultation</span>
                    </div>
                    <div class="d-flex justify-content-start">
                        <i class="mdi mdi-map-marker-outline mr-2 lead"></i>
                        <span class="mt-1"> {{$therapist['country']}}</span>
                    </div>
                    <a href="javascript:void(0)" wire:click='show' class="btn btn-sm btn-subtle-primary mt-2" wire:loading.attr='disabled' wire:target='show'>
                        <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target='show'></span>
                        Show Details</a>
            </div>
        </div>
    </div>
</div>
