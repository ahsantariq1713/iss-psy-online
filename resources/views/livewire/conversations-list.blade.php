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
            Conversations <small class="badge">{{$conversations->count()}} Total</small>
        </h1>
    </header>
    <div class="input-group input-group-alt mb-3 ">
        <div class="input-group rounded">
            <div class="input-group-prepend">
                <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
            </div><input type="text" class="form-control" placeholder="Search by name" wire:model.lazy="search" wire:keydown.enter='search'>
        </div>
    </div>
    <div class="card" wire:loading.remove>
        <div class="list-group list-group-messages list-group-flush list-group-bordered">
            @forelse ($conversations as $conversation)
            <div class="list-group-item {{$conversation->hasUnreadMessages() ?  'unread' : ''}}">
                <div class="list-group-item-figure">
                    <div class="avatar {{$conversation->hasUnreadMessages() ? 'has-badge' : ''}}">
                        <a href="#" class="user-avatar">
                            <img src="{{ asset($conversation->participant()->avatar) }}" alt="">
                        </a>
                        @if($conversation->hasUnreadMessages())
                        <span class="tile tile-xs tile-circle bg-red">{{$conversation->unreadMessagesCount()}}</span>
                        @endif
                    </div>
                </div>
                <div class="list-group-item-body pl-md-2">
                    <div class="row">
                        <div class="col-12 col-lg-3 d-none d-lg-block">
                            <h4 class="list-group-item-title text-truncate">
                                <span>{{$conversation->participant()->name}}</span>
                            </h4>
                            <p class="list-group-item-text"> {{$conversation->lastMessageAgo()}} </p>
                        </div>
                        <div class="col-12 d-lg-none">
                            <h4 class="list-group-item-title text-truncate">
                                <span>{{$conversation->participant()->name}}</span>
                            </h4>
                            <p class="list-group-item-text"> {{$conversation->lastMessageAgo()}} </p>
                        </div><!-- /grid column -->
                    </div><!-- /grid row -->
                </div><!-- /message body -->

                <div class="list-group-item-figure">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-icon btn-secondary" data-toggle="dropdown"
                            aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button> <!-- .dropdown-menu -->
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <div class="dropdown-arrow mr-n1"></div>
                            <a href="#" class="dropdown-item">Mark as read</a>
                            <a href="{{ route('conversation-show', [$conversation->id]) }}" class="dropdown-item">Show</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div id="notfound-state" class="empty-state">
                <!-- .empty-state-container -->
                <div class="empty-state-container">
                  <div class="state-figure">
                    <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}" alt="" style="max-width: 300px">
                  </div>
                  <h3 class="state-header"> No Content, Yet. </h3>
                  <p class="state-description lead text-muted"> No resources found to show. Add some new content or visit again to see if content is available. </p>
                </div>
              </div>
            @endforelse
        </div>
        <!-- loading spinner -->
    </div>
    <br><br><br>
    <div class="text-center w-100 h-100 my-auto text-muted">
        <div wire:loading.delay>
            <span class="spinner-border spinner-lg" style="height:72px;width:72px"></span>
        </div>
    </div>
</div>
