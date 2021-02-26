<div>
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="/dashboard"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Overview</a>
                </li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between">
            <h1 class="page-title mr-sm-auto">
                Support Tickets

            </h1>
            @if(not(Auth::user()->isAdmin()))
                <button class="btn btn-success" data-toggle="modal" data-target="#entity-modal">Add Ticket</button>
            @endif
        </div>

    </header>

    @if(not_null($tickets) && $tickets->count() > 0)
        <div class="card card-fluid">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        @if(Auth::user()->isAdmin())
                            <th style="min-width:200px"> User</th>
                        @endif
                        <th>Subject</th>
                        <th>Submitted At</th>
                        <th>Last Updated</th>
                        <th>status</th>
                        <th class="align-middle text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            @if(Auth::user()->isAdmin())
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <span class="btn-account">
                                            <span class="user-avatar user-avatar-md">
                                                <img src="{{asset($ticket->user->avatar)}}" alt="">
                                            </span>
                                            <span class="account-summary">
                                                <span class="account-name">{{$ticket->user->name}}</span>
                                                <span class="account-description">{{$ticket->user->role}}</span>
                                            </span>
                                        </span>
                                    </div>
                                </td>
                            @endif
                            <td>
                                <p class="m-0 p-0">{{$ticket->subject}}</p>
                            </td>

                            <td>{{$ticket->created_at->setTimeZone(Auth::user()->timezone)->format('d M, Y')}}</td>
                            <td>{{$ticket->updated_at->setTimeZone(Auth::user()->timezone)->diffForHumans()}}</td>
                            <td>
                                @if($ticket->status == 'Pending')
                                    <div class="badge badge-info"> {{$ticket->status}}</div>
                                @elseif($ticket->status == 'Awaiting Reply')
                                    <div class="badge badge-warning"> {{$ticket->status}}</div>
                                @else
                                    <div class="badge badge-danger"> {{$ticket->status}}</div>
                                @endif
                            </td>
                                <td class="align-middle text-right">
                                    <a href="{{route('support-ticket-details', [$ticket->id])}}" class="btn btn-icon btn-secondary" title="Show Details"><span class="mdi
                            mdi-clipboard-edit-outline
                            lead"></span> <span
                                            class="sr-only">Details</span></a>
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @else
        <div id="notfound-state" class="empty-state">
            <!-- .empty-state-container -->
            <div class="empty-state-container">
                <div class="state-figure">
                    <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}" alt="" style="max-width: 300px">
                </div>
                <h3 class="state-header"> No Content, Yet. </h3>
                <p class="state-description lead text-muted"> No resource found to show. </p>
                @if(not(Auth::user()->isAdmin()))
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#entity-modal">Add Ticket Now</button>
                @endif
            </div>
        </div>
    @endif

    <form wire:submit.prevent="addTicket" wire:ignore.self id="entity-modal" class="modal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title">New Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input class="form-control form-control-lg @error('subject') is-invalid @enderror" id="subject" type="text"
                               wire:model.defer="subject">
                        @error('subject')
                        <span class="invalid-feedback">{{$errors->first('subject')}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message"
                                  wire:model.defer="message" rows="10"></textarea>
                        @error('message')
                        <span class="invalid-feedback">{{$errors->first('message')}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ml-2" wire:loading.attr="disabled">
                        <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target="addTicket"></span>
                        Create Ticket
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
