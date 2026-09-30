<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $thread->title }}</title>
</head>
<body>
    <h1>{{ $thread->title }}</h1>
    <p><strong>Автор:</strong> {{ $thread->user->name }}</p>
    <p>{{ $thread->body }}</p>

    {{-- Проверка через Политику: может ли текущий пользователь удалить эту тему? --}}
    @can('delete', $thread)
        <div style="margin-top: 20px; padding: 10px; background: #f0f0f0;">
            <p><em>Эти кнопки видны только автору темы или администратору:</em></p>
            
            <a href="{{ route('threads.edit', $thread) }}">Редактировать</a>

            <form method="POST" action="{{ route('threads.destroy', $thread) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Удалить тему?')">Удалить</button>
            </form>
        </div>
    @endcan

    <p><a href="{{ route('threads.index') }}">← Назад к списку тем</a></p>
</body>
</html>