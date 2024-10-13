<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendWelcomeEMail implements ShouldQueue
{
    use Queueable;
    // for the job to be retried 3 times before it is marked as failed
    // backoff property is used to specify the number of seconds to wait before the job is retried
    public $tries=3;
   // public $backoff=[2, 10, 20];
   public $maxExceptions=3;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        sleep(3);
        // function () {
        //   check this
        //     return $this->release();
        // };
   

    }

    public function failed($e)
    {
        // Called when the job is failing...
        info('failed');


    }
}
