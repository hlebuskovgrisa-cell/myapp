<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 1. Добавляем необходимые импорты
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Enums\UserRoleEnum; // Исправлено: используем правильное имя нашего Enum

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 2. Определяем шлюз 'admin'
        Gate::policy(Post::class, PostPolicy::class);
        Gate::define('admin', function (User $user) {
            return $user->role === UserRoleEnum::ADMIN;
        });
    }
}