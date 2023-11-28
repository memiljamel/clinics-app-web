<?php

namespace App\Enums;

enum Role: string
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
