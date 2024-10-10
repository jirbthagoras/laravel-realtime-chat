<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    public $timestamps = true;
    public $incrementing = true;


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'joined_chat', 'chat_id', 'user_id');
    }

    public function messages(): hasMany
    {
        return $this->hasMany(Message::class, "chat_id", "id");
    }
}
