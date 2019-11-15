<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 11/14/19
 * Time: 9:41 AM
 */

namespace App\classes\sms;

/**
 * Class SmsSender
 * @package App\classes\sms
 * this class is responsible to calling api based on the input api.
 */
class SmsSender
{
    public $smsApi;

    /**
     * SmsSender constructor.
     * @param InterfaceApiSms $smsApi
     */
    public function __construct(InterfaceApiSms $smsApi)
    {
        $this->smsApi = $smsApi;
    }

    /**
     * @param InterfaceSmsInfo $smsInfo
     * @return bool
     */
    public  function sendMessage(InterfaceSmsInfo $smsInfo): bool
    {
        return $this->smsApi->callApi($smsInfo);
    }

    /**
     * @param InterfaceApiSms $smsApi
     */
    public function setSmsAPi(InterfaceApiSms $smsApi):void
    {
        $this->smsApi = $smsApi;
    }
}