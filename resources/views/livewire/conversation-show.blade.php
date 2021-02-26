<div class="card card-fluid" id="conversation-card" style="height:{{$height}}">
{{--    <div class="card-header">--}}
{{--        <div class="d-flex justify-content-start">--}}
{{--            <img src="{{asset($conversation->participant()->avatar)}}" class="rounded-circle" height="50" width="50"--}}
{{--                alt="">--}}
{{--            <h6 class="ml-3 mt-2">--}}
{{--                {{$conversation->participant()->name}}--}}
{{--                <br>--}}
{{--                <span class="small text-muted">--}}
{{--                    {{$conversation->participant()->isOnline() == null ? 'Online'  : 'Online'}}</span>--}}
{{--            </h6>--}}

{{--        </div>--}}
{{--    </div>--}}
    <div role="log" id="conversations" class="conversations card-body" style="overflow-y:scroll">
        <ul class="conversation-list">
            @foreach ($messages as $message)
            @php
            if($message->user_id != $userId && is_null($message->read_at) ){
                $message->markRead();
            }
            @endphp
            <li class="conversation-{{$message->outbound($userId) ? 'outbound': 'inbound'}} conversation-faux">
                <div class="conversation-message conversation-message-skip-avatar">
                    <div class="conversation-message-text">
                        {{$message->content}}
                        <div class="conversation-meta text-right {{$message->outbound($userId) ? 'text-white': ''}}">
                            {{$message->created_at->format('d M')}}
                            {{$message->created_at->setTimeZone($timezone)->format('h:i A')}} </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer">
        <div class="message-publisher" style="width: 100%!important">
            <div class="media">
                <div class="media-body">
                    <input type="text" class="form-control border-0 shadow-none" wire:model.debounce.500ms="content"
                        wire:keydown.enter='send' placeholder="Type a message">
                </div>
                <div>
                    <button type="button" class="btn btn-icon {{strlen($content) > 0 ? 'btn-primary' : 'btn-light'}}"
                        wire:click='send' wire:loading.attr='disabled' {{strlen($content) <= 0 ? 'disabled' : ''}}><i
                            class="fa fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function scrollToBottom(){
                let div = document.getElementById("conversations");
                div.scrollTop = div.scrollHeight;

            }
            $(document).ready(function(){
            @this.set('height', (window.innerHeight - 130)  + 'px');
                scrollToBottom();

                const definite = new Audio("{{asset('assets/sounds/definite.mp3')}}");
                window.Echo.channel(`chat${@this.chatId}`)
                    .listen('.message.received', function (e) {
                        window.livewire.emit('messageReceived', e.messgeId);
                        window.livewire.emit('refreshChat');
                        definite.play();
                    });

                window.livewire.on('scrollToBottom', ()=>{
                    scrollToBottom();
                })
            })

    </script>
</div>
