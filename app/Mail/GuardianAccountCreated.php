<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuardianAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $childName;
    public $guardianEmail;
    public $temporaryPassword;

    /**
     * Create a new message instance.
     */
    public function __construct($childName, $guardianEmail, $temporaryPassword)
    {
        $this->childName = $childName;
        $this->guardianEmail = $guardianEmail;
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Autorisation parentale requise - Brain Focus Football',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.guardian_account',
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
