<?php

namespace App\Enums;

enum UserType: string
{
    case Administrator = 'administrator';
    case Patient = 'patient';
}
