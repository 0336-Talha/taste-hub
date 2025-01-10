<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccessfull extends Mailable
{
    use Queueable, SerializesModels;
    public $msg;
    public $prod;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg, $prod)
    {
        //
        $this->msg=$msg;
        // $this->prod=$prod;
        $this->prod = $prod;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Your Order Successfully Placed ',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.orderSuccessfully',
          
            with: ['products' => $this->prod, 'msg'=>$this->msg] // Pass products to the view
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
