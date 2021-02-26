<div>
    <div class="pt-5 w-100 text-center" wire:loading.delay>
        <span class="spinner-border"></span>
    </div>
    <div wire:loading.remove>
        @if($mode == 'files')
        <h6> Files </h6>
        <input id="upload-input" type="file" wire:model='file' hidden>
        <button type="button" onclick="document.getElementById('upload-input').click();"
            class="btn btn-subtle-success btn-floated position-absolute">
            <i class="fa fa-upload" wire:loading.remove></i>
            <span class="spinner-border spinner-border-sm" wire:loading wire:target='file'></span>
        </button>
        <div class="list-group list-group-reflow list-group-flush list-group-divider" id="filesList">
            @foreach($appointment->files as $file)
            <div class="list-group-item align-items-start" id="file-{{ $file->id}}">
                <div class="list-group-item-figure">
                    <a href="#"
                        class="tile tile-circle  {{$file->user->role == \App\Helpers\UserRoles::THERAPIST ? 'bg-teal' : 'bg-pink'}} "><span
                            class="fa fa-file"></span></a>
                </div>
                <div class="list-group-item-body">
                    <h4 class="list-group-item-title text-truncate">
                        <a href="#"> {{$file->title}} </a>
                    </h4>
                    <p class="list-group-item-text "> by {{$file->user->name}} </p>
                    <span class="small text-muted">{{$file->created_at->calendar()}}</span>
                </div>
                <div class="list-group-item-figure">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-icon btn-light" data-toggle="dropdown"><i
                                class="fa fa-fw fa-ellipsis-v"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-arrow mr-n1"></div>
                            <a href="javascript:void(0)" class="dropdown-item"
                                wire:click='download({{$file->id}})'>Download</a>
                            @if($user->id == $file->user->id)
                            <a href="javascript:void(0)" class="dropdown-item"
                                wire:click='delete({{$file->id}})'>Remove</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @elseif($mode == 'recs')
            <div class="d-flex justify-content-between mb-2">
                <h6> Recommendations </h6>
                <span class="spinner-border spinner-border-sm" wire:loading wire:target='recs'></span>
            </div>
            @if($user->role == 'Therapist')
                <div wire:ignore>
                    <textarea class="form-control tiny" id="editor1">{{$appointment->recommendations}}</textarea>
                    <div class="text-right mt-2">
                        <button class="btn btn-primary" wire:loading.attr='disabled' wire:target='saveRecs' onclick="@this.set('recs',$('#editor1').summernote('code'))">
                            <span class="spinner-border spinner-border-sm mr-1" wire:target='saveRecs' wire:loading></span>
                            Save Recommendations
                        </button>
                    </div>
                    <script>
                        $('#editor1').summernote()
                    </script>
                </div>
            @else
            {!! $appointment->recommendations !!}
            @endif
        @elseif($mode == 'notes')
            <div class="d-flex justify-content-between mb-2">
                <h6> Private Notes </h6>
                <span class="spinner-border spinner-border-sm" wire:loading wire:target='notes'></span>
            </div>
            <div wire:ignore>
                <textarea class="form-control tiny" id="editor2">{{$appointment->notes}}</textarea>
                <div class="text-right mt-2">
                    <button class="btn btn-primary"  onclick="@this.set('notes',$('#editor2').summernote('code'))">
                        Save Notes
                    </button>
                </div>
                <script>
                    $('#editor2').summernote()
                </script>
            </div>
        @elseif($mode == 'chat')
            <livewire:conversation-show :clientId="$appointment->client->id" :therapistId="$appointment->therapist->id" :userId="$userId" wire:ignore/>
        @endif
    </div>
    <script type="text/javascript">
        document.addEventListener('livewire:load', () => {
                const definite = new Audio("{{asset('assets/sounds/definite.mp3')}}");
                window.Echo.channel(`appointment${@this.appointmentId}`)
                    .listen('.refresh.files', function (e) {
                            window.livewire.emit('refreshFiles');
                            definite.play();
                    });
                window.Echo.channel(`appointment${@this.appointmentId}`)
                    .listen('.refresh.recs', function (e) {
                            window.livewire.emit('refreshRecs');
                            definite.play();
                    });
            })
    </script>

</div>
