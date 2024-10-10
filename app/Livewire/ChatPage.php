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
    public function mount()
    {
        $this->user = Auth::user();

        $this->chats = $this->user->chats()->get();

    }

    public function render()
    {
        return view('livewire.chat-page', [
            "chats" => $this->chats
        ]);
    }
}
