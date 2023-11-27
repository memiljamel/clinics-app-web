<?php

namespace App\Enums;

enum MartialStatus: string
{
    /**
     * define the martial status as married.
     */
    case MARRIED = 'Married';

    /**
     * define the martial status as divorced.
     */
    case DIVORCED = 'Divorced';

    /**
     * define the martial status as single.
     */
    case SINGLE = 'Single';
}
