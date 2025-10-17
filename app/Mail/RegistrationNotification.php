<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use App\Models\Registration;

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

        // Ambil dokumen pendukung siswa
        $dokumen = $this->registration->siswa->dokumenPendukung ?? null;

        if ($dokumen) {
            // ==== Attach Surat Pengantar jika ada ====
            if ($dokumen->surat_pengantar) {
                $suratPath = storage_path('app/public/dokumen/surat_pengantar/' . $dokumen->surat_pengantar);
                if (file_exists($suratPath)) {
                    $attachments[] = Attachment::fromPath($suratPath)
                        ->as('Surat_Pengantar_' . $this->registration->siswa->name . '.' . pathinfo($suratPath, PATHINFO_EXTENSION))
                        ->withMime(mime_content_type($suratPath));
                }
            }

            // ==== Attach CV jika ada ====
            if ($dokumen->cv) {
                $cvPath = storage_path('app/public/dokumen/cv/' . $dokumen->cv);
                if (file_exists($cvPath)) {
                    $attachments[] = Attachment::fromPath($cvPath)
                        ->as('CV_' . $this->registration->siswa->name . '.' . pathinfo($cvPath, PATHINFO_EXTENSION))
                        ->withMime(mime_content_type($cvPath));
                }
            }
        }

        return $attachments;
    }
}
