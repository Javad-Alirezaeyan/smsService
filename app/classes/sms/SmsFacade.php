<?php


namespace App\classes\sms;
use Illuminate\Support\Facades\Facade;


class SmsFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'smsHandler';
    }
}