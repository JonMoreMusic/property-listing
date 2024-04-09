<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailSendingFailed
{
    use Dispatchable, SerializesModels;

    /**
     * The error message.
     *
     * @var string
     */
    public $errorMessage;

    /**
     * Create a new event instance.
     *
     * @param  string  $errorMessage
     * @return void
     */
    public function __construct($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
}
