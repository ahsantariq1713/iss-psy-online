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
    function loadVideo() {
        let lang = document.documentElement.lang;
        let url = 'https://www.youtube.com/embed/YojnHb7CtbU';

        if(lang == 'es') { url = 'https://www.youtube.com/embed/baDwEXxAWg0' }
        else if(lang == 'pt') { url = 'https://www.youtube.com/embed/InQLvmYXChg'}

        $('#video-frame').attr('src', url);
        $('#video-modal').modal('show');
    }

    document.addEventListener('livewire:load', function () {
        $("#video-modal").on("hidden.bs.modal", function () {
            $('#video-frame').attr('src', null);
        });
    });
</script>
<div id="videowrapper">
    <div id="fullScreenDiv">
        <video id="video" role="presentation" preload="auto" playsinline="" crossorigin="anonymous" loop="" muted=""
            autoplay="" class="blur">
            <source src="{{ asset('assets/videos/back.mp4') }}" type="video/mp4">
        </video>
        <div id="videoMessage" class="styling">
            <div class="container text-center">
                <a href="javascript:void(0)" class="video-btn"
                    onclick="loadVideo()">
                    <svg version="1.1" id="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="100px"
                        width="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                        <path class="stroke-solid" fill="none" stroke="white" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                        C97.3,23.7,75.7,2.3,49.9,2.5" />
                        <path class="stroke-dotted" fill="none" stroke="white" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                        C97.3,23.7,75.7,2.3,49.9,2.5" />
                        <path class="icon" fill="white"
                            d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />
                    </svg>
                </a>
                <br>
                <br>
                <h1>Find a Psychologist, Make an Appointment</h1>
                <p class="lead text-white">Connecting Psychologists and Patients worldwide fast, economically and in
                    your own language</p>
                <div class="d-flex justify-content-center" wire:ignore>
                    <div class="form-group w-50 text-left">
                        <select id="help-tags" class="form-control form-control-lg" data-toggle="select2"
                            data-placeholder="Conditions / Help For" data-allow-clear="true" multiple>
                            @foreach ($categories as $category)
                            <optgroup label="{{ $category->name }}">
                                @foreach ($category->specialisms as $specialism)
                                <option value="{{ $specialism->id }}"
                                    {{ collect(old('specialisms'))->contains($specialism->id) ? 'selected' : '' }}>
                                    {{ $specialism->name }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                        <script>
                            document.addEventListener('livewire:load', () => {
                                $('#help-tags').on('select2:select', e => @this.set('helpTags', $('#help-tags').val()));
                            });
                        </script>
                    </div>
                    <button type="button" class="btn btn-primary ml-2 " style="min-width:150px!important;" wire:loading.attr="disabled" wire:click="search">Find Therapists</button>
                </div>
            </div>
        </div>
    </div>
</div>
