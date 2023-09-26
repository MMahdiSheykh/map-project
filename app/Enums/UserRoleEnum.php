<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case ADMIN = 'ادمین کل';
    case KARSHENAS = 'ادمین';
    case SIMPLE_USER = 'کاربر';

}
