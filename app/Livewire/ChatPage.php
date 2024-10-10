<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatPage extends Component
{
    public $user;
    public $chats;
    public $message;

    public $chatId;
    public $selectedChat;
    public function mount()
    {
        $this->user = Auth::user();

        $this->chats = $this->user->chats()->get();


    }

    public function sendMessage()
    {
        dd($this->message);
    }

    public function changeChat(string $chatId)
    {
        $this->selectedChat = $chatId;
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

        return view('livewire.chat-page', [
            "chats" => $this->chats
        ]);
    }
}
