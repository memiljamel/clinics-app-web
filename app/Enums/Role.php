<?php

namespace App\Enums;

enum Role: string
{
    case Administrator = 'administrator';
    case Patient = 'patient';
}
