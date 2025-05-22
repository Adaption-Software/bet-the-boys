<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $email) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->email, // @phpstan-ignore-line
            subject: 'User Registration',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.user-registration',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
