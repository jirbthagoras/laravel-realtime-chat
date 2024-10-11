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

            messageElement.innerHTML = `<strong style="color:black">${data.username}: ${data.message}</strong> `;

            chatContainer.appendChild(messageElement);
        });
    </script>
    <div class="mx-auto content-center">
        <div class="bg-gray-100 rounded rounded-l-4xl mx-auto flex w-3/4 h-40 align-cnter justify-center items-center">
            <form action="" class="text-neutral-950 m" >
                <label for="" style="color:black" class="mx-auto justify-center content-center"> Join Chat:
                    <input style="color:black" type="number" wire:model="chatId" placeholder="Enter Chat Id ...">
                </label>
                <br>
                <button wire:click.prevent="join" style="color:black" class="bg-gray-100" type="submit">Join</button>
            </form>

        </div>
        <br>
        <div class="bg-gray-100 rounded rounded-l-4xl mx-auto w-1/4 h-8 flex justify-center content-center items-center align-center">
            <label for="" style="color:black"> Create Chat:
                <button wire:click.prevent="create" style="color: black" type="submit">Create</button>
            </label>
        </div>
        <br>
        <br>
        <div class="flex justify-between">
            <div>
                @foreach($chats as $chat)

                    <ul><h1 wire:click="changeChat({{$chat->id}})"><strong>Chat id: {{$chat->id}}</strong></h1></ul>
                    <p>In the chat:</p>
                    @foreach($chat->users()->get() as $user)
                        <div class="bg-black w-fit">
                        <li class="text-">{{$user->email}}</li>
                        </div>

                    @endforeach
                    <br>
                @endforeach
            </div>
            <h1></h1>

            @if($currentChat != null)

            <div class="rounded bg-white w-2/4 items-center justify-center text-center">
                <div id="chat-container">
                <h1 class="text-black">Welcome To The Chat current chat: {{$currentChat->id}}</h1>
                <hr>
                    <input wire:keydown.enter="sendMessage" wire:model="message" type="text" placeholder="Input text" class="w-2/3 text-black">
                </div>
                <div class="chat-container">
                </div>
                @foreach($messages as $message)
                    <h1 class="text-black"><strong>{{$message->sender}}</strong>: {{$message->message}}</h1>
                @endforeach
                </div>

            @else
            <div>
                Please Select A Chat To Start
            </div>
            @endif
        </div>
    </div>

</div>
