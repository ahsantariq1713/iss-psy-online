<div>
    {{-- Receive calling signal --}}
    <div class="modal fade" id="calling-received" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-sm" role="dialog" wire:ignore.self>
            <div class="modal-content py-5" wire:ignore.self>
                <div class="modal-body text-center">
                    <img src="{{asset($caller['avatar'])}}" height="150" width="150" class="rounded-circle mt-2">
                    <p class="m-0 mt-2 lead">{{$caller['name']}} is calling</p>
                    <p class="m-0 text-muted">Appointment # {{$caller['appointmentId']}}</p>
                </div>
                <div class="modal-footer text-center d-flex justify-content-center">
                    <button type="button" id="btn-decline" class="btn btn-danger">Decline</button>
                    <a href="{{$attendMeetingUrl}}" id="btn-attend" class="btn btn-success">Attend Meeting</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function repeatRing(){
            this.currentTime = 0;
            this.play();
        }
        function  ring() {
            callRing.play();
            callRing.addEventListener('ended', repeatRing , false);
        }
        var callRing = new Audio("{{asset('assets/sounds/call.mp3')}}");
       document.addEventListener('livewire:load',function () {

            window.Echo.channel(`user${@this.userId}`)
                .listen('.call.received', function (e) {
                    window.livewire.emit('callReceived', e.data.caller);
                    window.addEventListener('focus', ring)
                    $('#calling-received').modal('show');
                });
            $('#btn-decline').on('click', function () {
                callRing.removeEventListener('ended', repeatRing);
                window.removeEventListener('focus',ring);
                $('#calling-received').modal('hide');
                window.livewire.emit('rejectCall');
            });
       })
    </script>
    {{-- Receive Rejected Calling Signal --}}
</div>


