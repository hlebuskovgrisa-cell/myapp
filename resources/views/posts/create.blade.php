<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание статьи</title>
</head>
<body>
    <h1>Создать новую статью</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div>
            <label>Заголовок:</label><br>
            <input type="text" name="title" value="{{ old('title') }}" style="width: 400px;">
        </div>
        <div>
            <label>Текст статьи:</label><br>
            <textarea name="body" rows="10" style="width: 400px;">{{ old('body') }}</textarea>
        </div>
        <button type="submit">Создать</button>
    </form>

    <p><a href="{{ route('posts.index') }}">← Назад к списку</a></p>
</body>
</html>