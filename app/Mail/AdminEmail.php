<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content; // Import Content
use Illuminate\Mail\Mailables\Envelope; // Import Envelope
use Illuminate\Queue\SerializesModels;

class AdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $title;
    public $messageBody; // Renamed to avoid conflict with default $message

    /**
     * Create a new message instance.
     */
    public function __construct($email, $title, $messageBody)
    {
        $this->email = $email;
        $this->title = $title;
        $this->messageBody = $messageBody;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->title,
            replyTo: [$this->email], // If you want replies to go to the sender's email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'adminDashboard.admin_email', // Path to your HTML Blade email template
            // or if you prefer plain text:
            // text: 'emails.admin_email_plain',
            with: [
                'email' => $this->email,
                'messageBody' => $this->messageBody,
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