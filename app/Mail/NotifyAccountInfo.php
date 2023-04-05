<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyAccountInfo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $tenant;

    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Notify Account Info',
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
            view: 'emails.account-info',
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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.account-info')
            ->with([
                'email' => $this->tenant->email,
                'phone' => $this->tenant->phone_number,
                'password' => '12345678',
                'url' => url('/tenant/login')
            ])
            ->attach(public_path('vendors/images/logo-boarding-house.png'), [
                'as' => 'logo.png',
                'mime' => 'image/png',
            ]);
    }
}
