<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\MessageWasRecievedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationToOwnerListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
            $mail->from($message->email, $message->name)
                ->to('josufmc@hotmail.com', 'Josu')
                ->subject('Tu mensaje fue recibido');
        });
    }
}
