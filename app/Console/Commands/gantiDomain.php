<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class gantiDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ganti-domain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = Post::get();
        $data->map(function ($item) {
            $newdomain = str_replace('veenix.online', 'veenix.xyz', $item->image);
            $item->image = $newdomain;
            $item->save();
            return $item;
        });
    }
}
