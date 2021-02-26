<li class="nav-item dropdown header-nav-dropdown {{$hasUnread ? 'has-notified' : ''}}">
    <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="oi oi-pulse"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
        <div class="dropdown-arrow"></div>
        <h6 class="dropdown-header stop-propagation">
            <span>Activities</span>
        </h6>
        <div class="dropdown-scroll perfect-scrollbar ps">
            @foreach($unread as $notification)
                <a href="javascript:void(0)" wire:click="markRead({{$notification}})" class="dropdown-item unread">
                    <div class="user-avatar">
                        <img src="{{asset($notification->data['avatar'] ?? 'assets/images/users/default.png')}}" alt="">
                    </div>
                    <div class="dropdown-item-body">
                        <p class="m-0 text"> {{$notification->data['title']}} </p><span class="date">{{$notification->created_at->diffForHumans()}}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</li>
