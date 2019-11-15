<?php

namespace App\classes\sms;



/**
 * Class SmsApi_1
 * @package App\classes\sms
 *
 * First Api to sending Sms. This class is responsible transfer the sms to Api
 */
class SmsApi_1 implements InterfaceApiSms
{

    public function __construct()
    {
        
    }

    /**
     * @param InterfaceSmsInfo $sms
     * @return bool
     * this function hasn't been implemented. For now, we just use a random number to determines if the sms has been sent or not.
     */
    public function callApi(InterfaceSmsInfo $sms): bool
    {
        $number = $sms->mobile;
        $body = $sms->body;
        try{

            if(rand(0,1)){
                return true;
            }
            return false;
        }
        catch(\ErrorException $e){
            //Log error
            return false;
        }
    }
}