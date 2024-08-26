<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeadLinkVideo implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $resp = Http::get($this->data->link_video);

        if ($resp->body() === 'Content Has Been Remove') {
            $this->data->update(['dead_link_video' => 1]);
        } else {
            $this->data->update(['dead_link_video' => 0]);
        }
    }
}
