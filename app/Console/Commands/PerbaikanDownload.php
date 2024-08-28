<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PerbaikanDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:perbaikan-download';

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
        foreach ($data as $item) {
            $first_character = substr($item->link_download, 0, 1);
            if ($first_character == 'h') {
                $u = $item;
                $u->link_download = "[" . json_encode($item->link_download) . "]";
                $u->save();
            } else {
            }
        }
    }
}
