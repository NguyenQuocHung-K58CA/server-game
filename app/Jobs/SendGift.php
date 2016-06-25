<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\GiftDetail;

class SendGift extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $unSendGift;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($unSendGift)
    {
        $this->unSendGift = $unSendGift;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
