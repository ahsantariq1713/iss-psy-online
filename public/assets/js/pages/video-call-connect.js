// function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };
// $(document).ready(function(){
//     $(document).on("keydown", disableF5);
// });
alert("hello")
window.onbeforeunload = function() {
    return "Are you sure you want to leave or refresh?";
}

var session = null;
var publisher = null;

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if((minutes == 10 || minutes == 5) && seconds == 0){
            console.log(minutes)
                $('#span-termination').removeClass('d-none');
                let timerover = new Audio("https://psychologists-online.com/public/assets/sounds/timeover.mp3");
                timerover.play();
        }

        if (--timer < 0) {
            timer = duration;
        }
    },
    1000);
}

document.addEventListener('livewire:load', () => {
    window.livewire.on('connect', (payload) => {
        let apiKey = payload.key;
        let sessionId = payload.sessionId;
        let token = payload.token;
        let publisherName = payload.publisherName;
        let participantImageUrl = payload.participantImageUrl;
        session = OT.initSession(apiKey, sessionId);
        // Handling all of our errors here by alerting them
        function handleError(error) {
            if (error) {
                alert(error.message)
            }
        }

        // Subscribe to a newly created stream
        session.on("streamCreated", function (event) {
            var subscriber = session.subscribe(
                    event.stream,
                    "subscriber",
                    {
                        insertMode: "append",
                        width: "100%",
                        height: "100%",
                    },
                    function (error) {
                        if (error) {
                            console.log(error.message);
                            return;
                        }
                        if (subscriber.stream.hasVideo) {
                            var imgData = subscriber.getImgData();
                            subscriber.setStyle("backgroundImageURI", imgData);
                        } else {
                            subscriber.setStyle(
                                "backgroundImageURI",
                                participantImageUrl
                            );
                        }
                    }
            );
        });

        // Create a publisher
        publisher = OT.initPublisher(
                "publisher",
                {
                    name: publisherName,
                    insertMode: "append",
                    width: "100%",
                    height: "100%",
                },
                handleError
        );

        // Connect to the session
        session.connect(token, function (error) {
                // If the connection is successful, initialize a publisher and publish to the session
                if (error) {
                    handleError(error);
                } else {
                    session.publish(publisher, handleError);
                    startTimer(payload.seconds,  document.querySelector('#time'))
                }
        });

    });

});
