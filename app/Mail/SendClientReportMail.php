<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendClientReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $pdfPath;

    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Vaš nalaz vidne oštrine - OKO Glavaš')
            ->view('emails.report')
            ->text('emails.report_plain') // <- dodaje plain tekst verziju
            ->attach($this->pdfPath, [
                'as' => 'nalaz.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
