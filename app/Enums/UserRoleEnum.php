<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case USER = 0;
    case ADMIN = 1;
    case MODERATOR = 2; // Задел на будущее
}