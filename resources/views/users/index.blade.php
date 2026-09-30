<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление пользователями</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Управление пользователями</h1>
    
    @can('admin')
        <p>Вы вошли как администратор. Ниже — список всех пользователей.</p>
    @endcan

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{-- Выводим название роли из Enum --}}
                        {{ $user->role->name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form method="POST" action="/logout" style="margin-top: 20px;">
        @csrf
        <button type="submit">Выйти</button>
    </form>
</body>
</html>