<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryCodesMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $recoveryCodes;
    public function __construct($recoveryCodes)
    {
        $this->recoveryCodes = $recoveryCodes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.recovery_codes')
            ->from('propertylisting@civanolo.com')
            ->subject('Two factor authentication code')
            ->with([
                'recoveryCodes' => $this->recoveryCodes,
            ]);
    }
}
