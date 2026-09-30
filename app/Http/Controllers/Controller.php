<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
abstract class Controller
{
    // 2. Подключаем трейт
    use AuthorizesRequests;
}
