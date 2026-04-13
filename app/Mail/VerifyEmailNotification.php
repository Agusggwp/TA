<?php

namespace App\Mail;

use App\Models\KepalaKeluarga;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public KepalaKeluarga $kepalaKeluarga)
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->kepalaKeluarga->email,
            subject: 'Verifikasi Email Anda - Posyandu',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-email',
            with: [
                'kepalaKeluarga' => $this->kepalaKeluarga,
                'verificationUrl' => $this->kepalaKeluarga->getEmailVerificationUrl(),
            ],
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
