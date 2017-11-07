<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\MessageWasRecievedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAutoresponderListener
{
    /**
     * Handle the event.
     *
     * @param  MessageWasRecievedEvent  $event
     * @return void
     */
    public function handle(MessageWasRecievedEvent $event)
    {
        $message = $event->getMessage();
        
        Mail::send('emails.contact', ['msg' => $message], function($mail) use ($message){
            $mail->to($message->email, $message->name)->subject('Tu mensaje fue recibido');
        });
    }
}