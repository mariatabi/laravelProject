<?php

namespace App\Listeners;

use App\Events\SendTweet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotificationSendTweet
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
     * @param  SendMes  $event
     * @return void
     */
    public function handle(SendMes $event)
    {
        $data = array('name' => $event -> user-> name,
        'email' => $event -> user -> email,
        'body' => 'Hello! Nice to see you here! Feel yourself home');


        Log::channel('stack')->info('email', $data, function($message) use ($data) {
            $message -> to($data['email'])->subject('Thank you');
            $message -> from('noreply@artisanweb.net');
        });
    }
}
