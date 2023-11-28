<?php

namespace App\Enums;

enum PatientType: string
{
    /**
     * define the patient as general.
     */
    case GENERAL = 'General';

    /**
     * define the user as national health insurance.
     */
    case NHI = 'National Health Insurance';
}
