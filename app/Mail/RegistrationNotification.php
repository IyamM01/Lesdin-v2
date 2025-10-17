<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use App\Models\Registration;
use Illuminate\Support\Facades\Storage;

class RegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    /**
     * Create a new message instance.
     */
    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pendaftaran PKL Siswa Baru - SMK N 2 Depok Sleman',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        
        // Load dokumen pendukung siswa
        $dokumen = $this->registration->siswa->dokumenPendukung;
        
        if ($dokumen) {
            // Attach CV jika ada
            if ($dokumen->cv) {
                $cvPath = storage_path('app/public/dokumen/cv/' . $dokumen->cv);
                if (file_exists($cvPath)) {
                    $attachments[] = Attachment::fromPath($cvPath)
                        ->as('CV_' . $this->registration->siswa->name . '.pdf')
                        ->withMime('application/pdf');
                }
            }
        }
        
        return $attachments;
    }
}
