<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAccessUrlToUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    private $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bobansugareski@gmail.com')
                ->view('reports.email-access-url', ['url' => $this->url])
                ->subject('Access URL for a report');
    }
}
