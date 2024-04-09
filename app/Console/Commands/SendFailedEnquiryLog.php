<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendFailedEnquiryLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:failed-enquiry-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send number of failed enquiry emails to admin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get failed email count
        $failedEmailCount = Storage::get('failed_email_count.txt');

        // Send email to admin
        Mail::raw("Number of failed enquiry emails: $failedEmailCount", function ($message) {
            $message->to('admin@example.com')
                ->subject('Failed Enquiry Email Summary')
                ->from('propertylisting@civanolo.com');
        });

        $this->info('Email containing failed enquiry log sent to admin.');
    }
}
