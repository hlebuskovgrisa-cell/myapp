<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
</head>
<body>
    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    <h1>{{ $post->title }}</h1>
    <p><strong>Автор:</strong> {{ $post->user->name }}</p>
    <p>{{ $post->body }}</p>

    {{-- Директива @can проверяет Политику: может ли пользователь обновить/удалить эту статью --}}
    @can('update', $post)
        <div style="margin-top: 20px; padding: 10px; background: #f0f0f0;">
            <p><em>Вы видите эти кнопки, потому что вы автор или администратор:</em></p>
            
            <a href="{{ route('posts.edit', $post) }}">Редактировать</a>

            <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Удалить статью?')">Удалить</button>
            </form>
        </div>
    @endcan

    <p><a href="{{ route('posts.index') }}">← Назад к списку статей</a></p>
</body>
</html>