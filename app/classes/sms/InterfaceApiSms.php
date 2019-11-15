<?php


namespace App\classes\sms;


/**
 * Interface InterfaceApiSms
 * @package App\classes\sms
 *
 * This interface describes each Api class must be have the defined functions
 */
interface InterfaceApiSms
{
    public function  callApi(InterfaceSmsInfo $sms): bool;
}