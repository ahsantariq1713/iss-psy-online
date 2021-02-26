import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'a2879464268ea0a0e7c0',
    cluster: 'ap4',
    forceTLS: true
});

var channel = window.Echo.channel('my-channel');
channel.listen('.my-event', function (data) {
    alert(JSON.stringify(data));
});
