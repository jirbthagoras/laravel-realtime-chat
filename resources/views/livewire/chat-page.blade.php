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

    <div>
        <div class="bg-gray-100 rounded rounded-l-4xl">
            <form action="" class="text-neutral-950 m" >
                <label for="" style="color:black"> Join Chat
                    <input style="color:black" type="text" wire:model="chatId">
                </label>
            </form>
            <button wire:click.prevent="join" style="color:black" type="submit">Join</button>
        </div>
        <br>
        <div>
            <label for="" style="color:white"> Create Chat:
                <button wire:click.prevent="create" type="submit">Create</button>
            </label>
        </div>
        <div>
            @foreach($chats as $chat)
                <ul><strong>{{$chat->id}}</strong></ul>
                <p>In the chat:</p>
                @foreach($chat->users()->get() as $user)
                    <li class="text-2xl">{{$user->email}}</li>
                @endforeach
            @endforeach
        </div>
    </div>

</div>
