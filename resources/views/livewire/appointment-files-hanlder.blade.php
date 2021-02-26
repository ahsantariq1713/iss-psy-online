<div>
    @if(not(Auth::user()->isAdmin()) && $appointment->allowUpdate())
        <div class="position-absolute" style="bottom: -70px; right:0px">
            <input id="upload-input" type="file" wire:model='file' hidden>
            <button type="button" onclick="document.getElementById('upload-input').click();"
                    class="btn btn-subtle-success btn-floated position-absolute">
                <i class="fa fa-upload" wire:loading.remove></i>
                <span class="spinner-border spinner-border-sm" wire:loading wire:target='file'></span>
            </button>
        </div>
    @endif
    @if(count($appointment->files) <= 0)
        <div id="notfound-state" class="empty-state">
            <!-- .empty-state-container -->
            <div class="empty-state-container">
                <div class="state-figure">
                    <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}" alt="" style="max-width: 300px">
                </div>
                <h3 class="state-header"> No Content, Yet. </h3>
                <p class="state-description lead text-muted"> No file found to show. </p>
            </div>
        </div>
    @else
        <div class="card px-3 py-2">
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
                                    @if(Auth::id() == $file->user->id && $file->appointment->allowUpdate())
                                        <a href="javascript:void(0)" class="dropdown-item"
                                           wire:click='delete({{$file->id}})'>Remove</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    @endif
</div>
