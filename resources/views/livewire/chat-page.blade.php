<div>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('e42bf4bdbdbfbf279a0b', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('newMessage', function(data) {
            const chatContainer = document.getElementById('chat-container');

            const messageElement = document.createElement('div');
            messageElement.classList.add('chat-message');

            messageElement.innerHTML = `<strong style="color:white">${data.username}: ${data.message}</strong> `;

            chatContainer.appendChild(messageElement);
        });
    </script>


</div>
