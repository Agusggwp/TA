<?php

namespace App\Mail;

use App\Models\KepalaKeluarga;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejectionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $kepalaKeluarga;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct(KepalaKeluarga $kepalaKeluarga, $reason = null)
    {
        $this->kepalaKeluarga = $kepalaKeluarga;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pembaruan Status Pendaftaran - Posyandu',
            to: $this->kepalaKeluarga->email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rejection-notification',
            with: [
                'kepalaKeluarga' => $this->kepalaKeluarga,
                'reason' => $this->reason,
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
