<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeliveryMail extends Mailable
{
    use Queueable, SerializesModels;
    public $ord;
    public $items;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ord, $orderItem,$url)
    {
        $this->ord = $ord;
        $this->items = $orderItem;
        $this->url=$url;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Delivery Mail',
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
            view: 'emails.orderDeliver',
            with: [ 'ownerName' => $this->ord->order->orderMaker->accountUser->name, 'items' => $this->items, 'url'=>$this->url]
             // Pass products to the view
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
