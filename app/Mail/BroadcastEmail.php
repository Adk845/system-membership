<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BroadcastEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $email;
    public $namaPenerima;
    public function __construct($email, $namaPenerima)
    {
        $this->email = $email;
        $this->namaPenerima = $namaPenerima;
    }

    public function build()
    {
        $body = str_replace('[nama]', $this->namaPenerima, $this->email->body);
        return $this->subject($this->email->subject)
                    ->view('emails.email_template.broadcast')
                    ->with(['email' => $this->email,
                            'body' => $body,
                            'image' => $this->email->image_url,
                            'namaPenerima' => $this->namaPenerima
                            ]);
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Broadcast Email',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'email.email_template.broadcast',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
