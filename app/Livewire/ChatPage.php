<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatPage extends Component
{
    public $user;
    public $chats;
    public $message;

    public $currentChat;

    public $chatId;
    public $selectedChat;
    public function mount()
    {

    }

    public function sendMessage()
    {

        event(new \App\Events\MessageEvent("Hello World!", "Jirb", "Hello"));

        Message::query()
            ->create([
                "message" => $this->message,
                "sender" => $this->user->name,
                "user_id" => $this->user->id,
                "chat_id" => $this->currentChat->id
            ]);


        event(new \App\Events\MessageEvent($this->message, $this->user->name, $this->currentChat->id));
    }

    public function changeChat(string $chatId)
    {
        $this->currentChat = Chat::query()->where('id', "=", $chatId)->first();
    }

    public function create()
    {
        Chat::query()
            ->create([

            ]);

        $chat = Chat::query()
            ->get()
            ->last();

        $this->user->chats()->attach($chat->id);


    }

    public function join()
    {
        $this->user = Auth::user();

        $this->user->chats()->attach($this->chatId);
    }

    public function render()
    {
        $this->user = Auth::user();

        $this->chats = $this->user->chats()->get();

        if ($this->currentChat == null)
        {
            $this->currentChat = Chat::query()
                ->where('id', "=", $this->user->id)
            ->first();
        }

        if($this->currentChat != null)
        {
            return view('livewire.chat-page', [
                "chats" => $this->chats,
                "messages" => $this->currentChat->messages()->get(),
            ]);
        }

        return view('livewire.chat-page', [
            "chats" => $this->chats,
        ]);
    }
}
