<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $send_to_name = env('MAIL_CONTACT_US_RECIPIENT_NAME');
        $send_to_email = env('MAIL_CONTACT_US_RECIPIENT_EMAIL');

        return $this->to($send_to_email, $send_to_name)
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->replyTo($this->request->email, $this->request->first_name .' '. $this->request->last_name)
                    ->subject('Someone sent you a message from '.$this->request->from_url.' url!')
                    ->view('emails.landing.contact_us_message')
                    ->with([
                        'fromURL' => $this->request->from_url,
                        'firstName' => $this->request->first_name,
                        'lastName' => $this->request->last_name,
                        'email' => $this->request->email,
                        'messages' => nl2br($this->request->messages),
                    ]);
    }
}
