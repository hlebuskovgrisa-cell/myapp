<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // <-- Импорт фасада Log

class SendPostCreatedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Записываем информацию в лог (storage/logs/laravel.log)
        Log::info("Новая статья создана: {$this->post->title} (автор ID: {$this->post->user_id})");
        
        // В реальном проекте здесь могла бы быть отправка email:
        // Mail::to('admin@example.com')->send(new NewPostNotification($this->post));
    }
}