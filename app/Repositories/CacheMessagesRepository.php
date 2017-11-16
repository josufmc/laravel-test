<?php

namespace App\Repositories;

use App\Message;
use Illuminate\Support\Facades\Cache;
use App\Repositories\IMessagesRepository;


class CacheMessagesRepository implements IMessagesRepository{

    private $messagesRepository;
    
    public function __construct(MessagesRepository $messagesRepository){
        $this->messagesRepository = $messagesRepository;
    }
    
    public function getPaginatedMessages(){
        $key = 'messages.page.'. request('page', 1);
        $messages = Cache::tags('messages')->rememberForever($key, function(){
            return $this->messagesRepository->getPaginatedMessages();
        });
        return $messages;
    }

    public function storeMessage($request){
        $message = $this->messagesRepository->storeMessage($request);
        Cache::tags('messages')->flush();
        return $message;
    }

    public function findById($id){
        $key = 'messages.'. $id;
        $message = Cache::tags('messages')->rememberForever($key, function() use ($id){
            return $this->messagesRepository->findById($id);
        });
        return $message;
    }

    public function update($request, $id){
        $message = $this->messagesRepository->update($request, $id);
        Cache::tags('messages')->flush();
        return $message;
    }

    public function destroy($id){
        $this->messagesRepository->destroy($id);
        Cache::tags('messages')->flush();
    }
}