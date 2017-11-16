<?php

namespace App\Repositories;

use App\Message;
use Illuminate\Support\Facades\Cache;


class MessagesRepository {

    public function getPaginatedMessages(){
        $key = 'messages.page.'. request('page', 1);
        $messages = Cache::tags('messages')->rememberForever($key, function(){
            $regPag = 20;
            $messages = Message::with(['user', 'note', 'tags'])
                ->orderBy('created_at', request('sorted', 'ASC'))
                ->paginate($regPag);
            return $messages;
        });
        return $messages;
    }

    public function storeMessage($request){
        $message = Message::create($request->all());
        if (auth()->check()){
            $message->user_id = auth()->user()->id;
            $message->save();
        }
        Cache::tags('messages')->flush();
    }

    public function findById($id){
        $key = 'messages.'. $id;
        $message = Cache::tags('messages')->rememberForever($key, function() use ($id){
            $message = Message::findOrFail($id);
            return $message;
        });
        return $message;
    }

    public function update($request, $id){
        $message = Message::findOrFail($id);
        $message->update($request->all());
        Cache::tags('messages')->flush();
        return $message;
    }

    public function destroy($id){
        $message = Message::findOrFail($id);
        $message->delete();
        Cache::tags('messages')->flush();
    }
}