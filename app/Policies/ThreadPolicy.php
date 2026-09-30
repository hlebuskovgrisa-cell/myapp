<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;
use App\Enums\UserRoleEnum; // <-- Правильный импорт

class ThreadPolicy
{
    // ... другие методы ...

    public function delete(User $user, Thread $thread): bool
    {
        // Разрешаем удаление, ЕСЛИ юзер - админ, ИЛИ юзер - автор темы
        return $user->role === UserRoleEnum::ADMIN || $user->id === $thread->user_id;
    }
}