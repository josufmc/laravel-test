<?php

namespace App\Repositories;

use App\Message;
use Illuminate\Support\Facades\Cache;
use App\Repositories\IMessagesRepository;


class MessagesRepository implements IMessagesRepository {

    public function getPaginatedMessages(){
        $regPag = 20;
        $messages = Message::with(['user', 'note', 'tags'])
            ->orderBy('created_at', request('sorted', 'DESC'))
            ->paginate($regPag);
        return $messages;
    }

    public function storeMessage($request){
        $message = Message::create($request->all());
        if (auth()->check()){
            $message->user_id = auth()->user()->id;
            $message->save();
        }
        return $message;
    }

    public function findById($id){
        $message = Message::findOrFail($id);
        return $message;
    }

    public function update($request, $id){
        $message = Message::findOrFail($id);
        $message->update($request->all());
        return $message;
    }

    public function destroy($id){
        $message = Message::findOrFail($id);
        $message->delete();
    }
}