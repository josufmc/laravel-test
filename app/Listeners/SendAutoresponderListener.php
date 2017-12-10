<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\MessageWasRecievedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAutoresponderListener implements ShouldQueue
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

        if (auth()->check()){
            $message->nombre = auth()->user()->name;
            $message->email = auth()->user()->email;
        }
        
        Mail::send('emails.contact', ['msg' => $message], function($mail) use ($message){
            $mail->to($message->email, $message->nombre)->subject('Tu mensaje fue recibido');
        });
    }
}
