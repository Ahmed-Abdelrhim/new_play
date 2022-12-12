<?php

namespace App\Listeners;

use App\Events\MailEvent;
use App\Models\BlogPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class MailListener
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
     * @param  \App\Events\MailEvent  $event
     * @return void
     */
    public function handle(MailEvent $event): void
    {
        // dd($event);

        Cache::forget('posts');
        Cache::forever('posts',BlogPost::all());
        //info('BlogPost Has Been Created Successfully ' . $event->post->id);
    }
}
