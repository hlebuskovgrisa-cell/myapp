<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все статьи</title>
    <style>
        /* Немного стилей для пагинации, чтобы она выглядела аккуратно */
        .pagination { margin-top: 20px; }
        .pagination a, .pagination span { 
            display: inline-block; 
            padding: 5px 10px; 
            margin: 2px; 
            border: 1px solid #ccc; 
            text-decoration: none; 
            color: #333;
        }
        .pagination .active span { background: #333; color: #fff; }
    </style>
</head>
<body>
    <h1>Все статьи</h1>

    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif
    
    <a href="{{ route('posts.create') }}">Создать новую статью</a>
    <hr>

    @forelse ($posts as $post)
        <div style="margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
            <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
            <p>Автор: {{ $post->user->name }} | Дата: {{ $post->created_at->format('d.m.Y H:i') }}</p>
        </div>
    @empty
        <p>Статей пока нет. Создайте первую!</p>
    @endforelse

    {{-- Ссылки пагинации --}}
    <div class="pagination">
        {{ $posts->links() }}
    </div>

    <hr>
    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Выйти</button>
    </form>
</body>
</html>