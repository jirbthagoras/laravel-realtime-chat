<?php

namespace Tests\Feature;

use App\Models\Chat;
use App\Models\Message;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManyToManyUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = \App\Models\User::query()
            ->where("email", "=", "hansjabriel@gmail.com")
        ->first();

        Chat::query()
            ->create([]);

        $chat = Chat::query()
            ->first();

        Message::query()
            ->create([
                "message" => "Hello",
                "user_id" => $user->id,
                "chat_id" => $chat->id,
            ]);

//        $user->chats()->attach($chat->id);



        foreach ($chat->users()->get() as $user) {
            var_dump($user->name);
        }

        $messages = $chat->messages()->get();

//        foreach ($messages as $item) {
//            var_dump($item->message);
//        }

    }
}
