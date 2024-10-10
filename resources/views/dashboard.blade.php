<x-app-layout>
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
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="chat-container">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
