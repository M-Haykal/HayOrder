<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Restaurant;

class SendEmailDashboard extends Mailable
{
    use Queueable, SerializesModels;

    public $restaurant;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct(Restaurant $restaurant, string $url)
    {
        $this->restaurant = $restaurant;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Your Restaurant Has Been Approved')
            ->markdown('emails.sendLinkDashboard');
    }
    

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Email Dashboard',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
