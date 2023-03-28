<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendBillViaEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $bill;

    public function __construct($bill)
    {
        $this->bill = $bill;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Send Bill Via Email',
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
            view: 'emails.room-billing',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            public_path('vendors/images/logo-boarding-house.png'),
        ];
    }

    public function build()
    {
        return $this->subject('Notice of room billing - ' . $this->bill->billDate)
            ->view('emails.room-billing')
            ->with([
                'bill' => $this->bill,
            ])
            ->attach(public_path('vendors/images/logo-boarding-house.png'), [
                'as' => 'logo.png',
                'mime' => 'image/png',
            ]);
    }
}
