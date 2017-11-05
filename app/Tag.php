<?php

namespace App;

use App\User;
use App\Message;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function messages(){
        return $this->morphedByMany(Message::class, 'taggable');
    }

    public function users(){
        return $this->morphedByMany(User::class, 'taggable');
    }
}
