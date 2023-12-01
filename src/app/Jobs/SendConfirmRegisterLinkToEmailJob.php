<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegisterLinkMail;

class SendConfirmRegisterLinkToEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(private $link)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('recipient@example.com')->send(new SendRegisterLinkMail($this->link));
    }
}
