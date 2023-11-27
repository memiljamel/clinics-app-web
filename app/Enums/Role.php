<?php

namespace App\Enums;

enum UserType: string
{
    /**
     * define the user as administrator.
     */
    case ADMINISTRATOR = 'Administrator';

    /**
     * define the user as patient.
     */
    case PATIENT = 'Patient';
}
