<li class="nav-item dropdown header-nav-dropdown {{$hasUnreadMessages ? 'has-notified' : ''}}">
    <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
            class="oi oi-envelope-open"></span></a>
    <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
        <div class="dropdown-arrow"></div>
        <h6 class="dropdown-header stop-propagation">
            <span>Messages</span>
        </h6>
        <div class="dropdown-scroll perfect-scrollbar ps">
            @foreach ($messages as $message)
            <a href="{{ route('conversation-show', [$message->conversation_id]) }}" class="dropdown-item unread">
                <div class="user-avatar">
                    <img src="{{ asset($message->user->avatar) }}" alt="">
                </div>
                <div class="dropdown-item-body">
                    <p class="subject"> {{$message->user->name}} </p>
                    <p class="text text-truncate"> {{$message->content()}} </p><span class="date">
                        {{$message->created_at->diffForHumans()}}</span>
                </div>
            </a>
            @endforeach
        </div>
        <a href="/conversations" class="dropdown-footer">All Conversations <i
                class="fas fa-fw fa-long-arrow-alt-right"></i></a>
    </div>
</li>
