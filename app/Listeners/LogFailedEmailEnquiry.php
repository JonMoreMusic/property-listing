<?php

namespace App\Listeners;

use App\Events\EmailSendingFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class LogFailedEmailEnquiry
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EmailSendingFailed  $event
     * @return void
     */
    public function handle(EmailSendingFailed $event)
    {
        // Get current count of failed emails
        $failedEmailCount = Storage::get('failed_email_count.txt');

        // Increment count by 1
        $failedEmailCount++;

        // Save updated count to file
        Storage::put('failed_email_count.txt', $failedEmailCount);
        //dd('updated storage');
    }
}
