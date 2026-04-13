<?php

namespace App\Mail;

use App\Models\KepalaKeluarga;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $kepalaKeluarga;

    /**
     * Create a new message instance.
     */
    public function __construct(KepalaKeluarga $kepalaKeluarga)
    {
        $this->kepalaKeluarga = $kepalaKeluarga;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Akun Anda Telah Disetujui - Posyandu',
            to: $this->kepalaKeluarga->email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.approval-notification',
            with: [
                'kepalaKeluarga' => $this->kepalaKeluarga,
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
