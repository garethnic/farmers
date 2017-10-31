<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Minishlink\WebPush\WebPush;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $push = new WebPush();

        $push->sendNotification(
            $this->data[1]['endpoint'],
            null,
            $this->data[1]['p256dh'],
            $this->data[1]['auth'],
            true,
            ['TTL' => 5000, 'urgency' => 'high'],
            $this->data[0]
        );
    }
}
