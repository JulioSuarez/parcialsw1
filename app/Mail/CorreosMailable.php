<?php

namespace App\Mail;

use App\Models\User;
use App\Models\diagrama;
use AWS\CRT\HTTP\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\View\View;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorreosMailable extends Mailable
{
    use Queueable, SerializesModels;


    public $d;
    public $p;
    public $e;

    /**
     * Create a new message instance.
     */
    public function __construct($d,$p,$e)
    {
        $this->d = $d;
        $this->p = $p;
        $this->e = $e;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitacion a la plataforma de diagramas',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('VistaEmail.index',[
            'd' => $this->d,
            'p' => $this->p,
            'e' => $this->e,
        ]);
    }
    // public function content(): Content
    // {
    //     return $this->view('VistaEmail.index');
    // }



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
