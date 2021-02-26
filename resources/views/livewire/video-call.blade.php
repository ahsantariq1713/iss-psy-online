<div class="has-sidebar has-sidebar-fluid h-100 p-0 {{$hasSidebar ? 'has-sidebar-open' : ''}}">
    <div class="h-100 p-0">
        <div class="w-100 text-center" style="background-color: black!important;">

            <div class="position-absolute px-2 {{not($connected) ? 'd-block' :'d-none'}}"
                style="z-index:15;padding-top:100px;width:99%">>
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-sm-12 offset-lg-4 offset-md-2">
                        <h4 class="text-light mb-3">Attend Appointment Session</h4>
                            <div class="card text-left">
                                <div class="card-header border-0 pb-0">
                                    <h6 class="mb-1">Enter your password</h6>
                                    <p class="m-0 text-muted font-weight-normal">We need your account password to
                                        connect with the participant</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            id="password" placeholder="Password" wire:model.defer="password">
                                        @error('password')
                                        <span class="invalid-feedback">{{$errors->first('password')}}</span>
                                        @enderror
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-lg btn-success" wire:click="connect"
                                            wire:loading.attr='disabled'>
                                            <span class="spinner-border spinner-border-sm mr-1"
                                                wire:loading.delay></span>
                                            Start Call
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div id="publisher-back" class="position-absolute text-center w-100"
                style="z-index:5;height:100% ;background-color: black!important;padding-top:100px">
                <div class="{{$connected ? 'd-block' :'d-none'}}">
                    <p class="m-0 w-100 text-center"><span class="spinner-border text-white"></span> </p>
                    <p class="lead text-white mt-2">Waiting for other participants to connect ...</p>
                </div>
            </div>

            <div id="publisher" wire:ignore></div>
            <div id="subscriber" wire:ignore> </div>

            <div id="actionbar" class="{{$connected ? 'd-block' : 'd-none'}}">

                <div class="mb-2">
                    <span class="font-weight-bold h6 mr-1 text-danger d-none" id="span-termination">This meeting will be terminated in:  </span>
                    <span id="time" class="h6" wire:ignore  style="min-width:100px!important">00:00</span>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0)" title="Files" class="btn btn-lg btn-white border btn-circle mr-2"
                        onclick="toggleSidebar('files')">
                        <div class="bg-success rounded-circle {{$filesChanged ? 'd-block':'d-none'}}"
                            style="height:15px!important;width:15px!important;position:absolute;margin-top:-15px;margin-left:-10px">
                        </div>
                        <span class="material-icons">
                            attach_file
                        </span>
                    </a>
                    <a href="javascript:void(0)" title="Recommendations"
                        class="btn btn-lg btn-white border btn-circle mr-2" onclick="toggleSidebar('recs')">
                        <div class="bg-success rounded-circle {{$recChanged ? 'd-block':'d-none'}}"
                            style="height:15px!important;width:15px!important;position:absolute;margin-top:-15px;margin-left:-10px">
                        </div>
                        <span class="material-icons">
                            assistant
                        </span>
                    </a>
                    @if($user->role == 'Therapist')
                    <a href="javascript:void(0)" title="Private Notes"
                        class="btn btn-lg btn-white border btn-circle mr-2" onclick="toggleSidebar('notes')">
                        <span class="material-icons">
                            description
                        </span>
                    </a>
                    @endif
                    <a href="javascript:void(0)" title="Chat" class="btn btn-lg btn-white border btn-circle mr-2"
                       onclick="toggleSidebar('chat')">
                        <div class="bg-success rounded-circle {{$chatChanged ? 'd-block':'d-none'}}"
                             style="height:15px!important;width:15px!important;position:absolute;margin-top:-15px;margin-left:-10px">
                        </div>
                        <span class="material-icons">
                           chat_bubble_outline
                        </span>
                    </a>
                    <a href="javascript:void(0)" title="Toggle Camera" class="btn btn-lg btn-white border btn-circle mr-2"
                       onclick="toggleCamera()">
                        <div class="bg-success rounded-circle {{$chatChanged ? 'd-block':'d-none'}}"
                             style="height:15px!important;width:15px!important;position:absolute;margin-top:-15px;margin-left:-10px">
                        </div>
                        <span class="material-icons" id="camera-icon">
                            no_photography
                        </span>
                    </a>
                    <a href="/dashboard"  title="Close Meeting" class="btn btn-lg btn-danger border btn-circle">
                        <span class="material-icons text-white">
                            phone_disabled
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore>
        <div class="page-sidebar">
            <header class="sidebar-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <a href="#" onclick="window.livewire.emit('setMode', 'close');Looper.toggleSidebar()">Close
                                <i class="breadcrumb-icon fa fa-angle-right mr-2"></i></a>
                        </li>
                    </ol>
                </nav>
            </header>
            <div class="sidebar-section">
                <livewire:video-call-sidebar userId="{{$userId}}" appointmentId="{{$appointmentId}}" />
            </div>
        </div>
    </div>

    <div wire:ignore>
        {{-- <script src="{{ asset('assets/js/pages/video-call-connect.js')}}"></script> --}}
<script type="text/javascript">
window.onbeforeunload = function() {
    return "Are you sure you want to leave or refresh?";
}

var session = null;
var publisher = null;
var publishVideo = true;

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;
        if(timer == 600){
            $('#span-termination').removeClass('d-none');
        }
        if(timer == 603 || timer == 303 || timer == 13){
                let timerover = new Audio("https://psychologists-online.com/public/assets/sounds/timeover.mp3");
                let c = timer == 603 || timer == 303 ? 3 : 4 ;
                let interval =  setInterval(() => {
                    c-=1;
                    if(c === 0){
                        clearInterval(interval);
                    }
                    timerover.play();
                }, 3000);
        }

        if (--timer < 0) {
            // timer = duration;
            window.onbeforeunload = null;
            window.location.href="/dashboard";
        }
    },
    1000);
}

function toggleCamera(){
    publishVideo = !publishVideo;
    publisher.publishVideo(publishVideo);
    $("#camera-icon").text(publishVideo ?  "no_photography" :"photo_camera");


}

document.addEventListener('livewire:load', () => {
    window.livewire.on('connect', (payload) => {
        let apiKey = payload.key;
        let sessionId = payload.sessionId;
        let token = payload.token;
        let publisherName = payload.publisherName;
        let participantImageUrl = payload.participantImageUrl;
        session = OT.initSession(apiKey, sessionId);
        // Handling all of our errors here by alerting them
        function handleError(error) {
            if (error) {
                alert(error.message)
            }
        }

        // Subscribe to a newly created stream
        session.on("streamCreated", function (event) {
            var subscriber = session.subscribe(
                    event.stream,
                    "subscriber",
                    {
                        insertMode: "append",
                        width: "100%",
                        height: "100%",
                    },
                    function (error) {
                        if (error) {
                            console.log(error.message);
                            return;
                        }
                        if (subscriber.stream.hasVideo) {
                            var imgData = subscriber.getImgData();
                            subscriber.setStyle("backgroundImageURI", imgData);
                        } else {
                            subscriber.setStyle(
                                "backgroundImageURI",
                                participantImageUrl
                            );
                        }
                    }
            );
        });

        // Create a publisher
        publisher = OT.initPublisher(
                "publisher",
                {
                    name: publisherName,
                    insertMode: "append",
                    width: "100%",
                    height: "100%",
                },
                handleError
        );



        // Connect to the session
        session.connect(token, function (error) {
                // If the connection is successful, initialize a publisher and publish to the session
                if (error) {
                    handleError(error);
                } else {
                    session.publish(publisher, handleError);
                    startTimer(payload.seconds,  document.querySelector('#time'))
                }
        });

    });

});

</script>
        <script type="text/javascript">
            function toggleSidebar(mode){
                window.livewire.emit('setMode', mode);
            }

            document.addEventListener('livewire:load',function(){
                window.Echo.channel(`user${@this.userId}`)
                    .listen('.call.rejected', function (e) {
                        window.livewire.emit('callRejected');
                    });
            })
        </script>
    </div>
</div>
