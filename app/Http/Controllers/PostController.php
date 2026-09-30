<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;        
use Illuminate\Pagination\LengthAwarePaginator; 
use App\Jobs\SendPostCreatedNotification;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    // Список всех статей (с кешированием)
    public function index()
    {
        $page = request()->get('page', 1);
        
        // Пытаемся получить список статей из кеша (хранится 60 секунд)
        $posts = Cache::remember("posts.page.{$page}", 60, function () {
            return Post::with('user')
                ->latest()
                ->paginate(10);
        });

        // Проверка: если из кеша вернулся не пагинатор, сбрасываем кеш
        if (!$posts instanceof LengthAwarePaginator) {
            Cache::forget("posts.page.{$page}");
            $posts = Post::with('user')->latest()->paginate(10);
        }

        return view('posts.index', compact('posts'));
    }

    // Форма создания новой статьи
    public function create()
    {
        return view('posts.create');
    }

    // Сохранение новой статьи
    public function store(Request $request)
{
    Cache::flush();

    $validated = $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
    ]);

    $validated['user_id'] = Auth::id();

    $post = Post::create($validated); // <-- Сохраняем статью в переменную

    // Отправляем задачу в очередь (она выполнится в фоне)
    SendPostCreatedNotification::dispatch($post);

    return redirect()->route('posts.index')->with('status', 'Статья успешно создана!');
}

    // Просмотр одной статьи
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Форма редактирования статьи
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    // Сохранение изменений
    public function update(Request $request, Post $post)
    {
        Cache::flush(); // Очищаем кеш при обновлении

        Gate::authorize('update', $post);
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post)->with('status', 'Статья обновлена!');
    }

    // Удаление статьи
    public function destroy(Post $post)
    {
        Cache::flush(); // Очищаем кеш при удалении

        $this->authorize('delete', $post);
        
        $post->delete();
        
        return redirect()->route('posts.index')->with('status', 'Статья удалена!');
    }
}