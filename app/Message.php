<?php

namespace App;

use App\User;
use App\Note;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['nombre', 'email', 'mensaje'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function note(){
        return $this->morphOne(Note::class, 'notable');
    }
}
