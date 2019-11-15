<?php

namespace App\classes\sms;

/**
 * Interface InterfaceSmsInfo
 * @package App\classes\sms
 * this interface determines each model pr class that keeps the information of a message, must  implements the defined functions
 */

interface InterfaceSmsInfo
{
    public function updateState(array $res);

}