<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование статьи</title>
</head>
<body>
    <h1>Редактировать статью</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Заголовок:</label><br>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" style="width: 400px;">
        </div>
        <div>
            <label>Текст статьи:</label><br>
            <textarea name="body" rows="10" style="width: 400px;">{{ old('body', $post->body) }}</textarea>
        </div>
        <button type="submit">Сохранить</button>
    </form>

    <p><a href="{{ route('posts.show', $post) }}">← Назад к статье</a></p>
</body>
</html>