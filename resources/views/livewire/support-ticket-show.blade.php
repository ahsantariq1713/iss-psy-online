<div>
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="/dashboard"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Overview</a>
                </li>
            </ol>
        </nav>
        <h1 class="page-title mr-sm-auto">
            Support Ticket # {{$ticket->id}}
        </h1>
        <h5 class="m-0 text-muted">{{$ticket->subject}}</h5>
    </header>

    @foreach($ticket->ticketMessages as $message)
        <div class="card">
            <div class="card-body bg-light">
                <div class="d-flex justify-content-between">
                     <span class="btn-account">
                                            <span class="user-avatar user-avatar-md">
                                                <img src="{{asset($message->user->avatar)}}" alt="">
                                            </span>
                                            <span class="account-summary">
                                                <span class="account-name">{{$message->user->name}}</span>
                                                <span class="account-description">{{$message->user->role}}</span>
                                            </span>
                                        </span>
                    <span class="text-muted">{{$message->created_at->setTimeZone(Auth::user()->timezone)->diffForHumans()}}</span>
                </div>
            </div>
            <div class="card-footer border-top p-3 ">
                <p class="m-0">
                    {{$message->content}}
                </p>
            </div>
        </div>
    @endforeach

    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label for="message">
                Reply
            </label>
            @if($ticket->status == 'Pending')
                <span class="text-muted">Status :  <span class="font-weight-bold text-info"> {{$ticket->status}}</span> </span>
            @elseif($ticket->status == 'Awaiting Reply')
                <span class="text-muted">Status : <span class="font-weight-bold text-warning"> {{$ticket->status}}</span> </span>
            @else
                <span class="text-muted">Status :  <span class="font-weight-bold text-danger"> {{$ticket->status}}</span> </span>
            @endif
        </div>

        <textarea {{$ticket->status == 'Closed' ? 'readonly' : ''}}  class="form-control  @error('message') is-invalid @enderror" id="message"
                  wire:model.defer="message" rows="5"></textarea>
        @error('message')
        <span class="invalid-feedback">{{$errors->first('message')}}</span>
        @enderror
    </div>
    <div class="d-flex justify-content-{{$ticket->status == 'Closed' ? 'end' : 'between'}}">
        @if($ticket->status != 'Closed')
            <button class="btn btn-danger"  wire:click="closeTicket" wire:target="closeTicket" wire:loading.attr="disabled">Close Ticket</button>
        @endif
        <button class="btn btn-success" {{$ticket->status == 'Closed' ? 'disabled' : ''}}
                    wire:click="addMessage" wire:target="addMessage" wire:loading.attr="disabled">Submit</button>
    </div>

</div>
