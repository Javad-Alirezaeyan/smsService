<?php

namespace App\classes\sms;


/**
 * Class SmsApiFactory
 * @package App\classes\sms
 * this class determines which Api must be consumed to sending sms
 */
class SmsApiFactory
{
    private   $apiSources = [];
    private   $apiIndex = 0;

    public function __construct()
    {
        $this->apiSources = [
            API1_TITLE => new SmsApi_1(),
            API2_TITLE=>new SmsApi_2()
        ];
    }

    /**
     * @return InterfaceApiSms
     * this method returns the first api
     */
    public function getFirstApi():InterfaceApiSms
    {
        return $this->apiSources[API1_TITLE];
    }

    /**
     * @return mixed|null
     */
    public function getNextApi()
    {
        $this->apiIndex += 1;
        return  isset($this->apiSources[$this->apiIndex]) ? $this->apiSources[$this->apiIndex] : null ;
    }

    public function getApIndex():string
    {
        return  $this->apiIndex;
    }




}