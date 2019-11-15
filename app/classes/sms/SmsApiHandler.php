<?php

namespace App\classes\sms;


use App\SmsFail;

/**
 * Class SmsApiHandler
 * @package App\classes\sms
 * this class is responsible to handle the sms to the SmsSender class. This class is accessible by a Facade(SmsFacade)
 */
class SmsApiHandler
{

    public function __construct()
    {
    }

    /**
     * @param InterfaceSmsInfo $smsModel
     * @return bool
     *this  method pass the sms to the SmsSender. First it gives a Api from SmsApiFactory and passes the api to the SmsSender
     * If the api couldn't send the sms, the SmsApiFactory is called again to retrieve another Api
     */
    public static function sendMessage(InterfaceSmsInfo $smsModel ):bool
    {
        $smApiFactory = new SmsApiFactory();
        $api = $smApiFactory->getFirstApi();
        $smsSender = new SmsSender($api);

        do{
            $res = $smsSender->sendMessage($smsModel);
            if($res){
                break;
            }
            // logging the failed sms
            SmsFail::insert( $smApiFactory->getApIndex(),  $smsModel->id);
            //
            $api = $smApiFactory->getNextApi();
            if($api){
                $smsSender->setSmsAPi($api);
            }

        }while($api);

        if($api !== null){
            $apiNumber = $smApiFactory->getApIndex();
        }
        else{
            $apiNumber = "";
        }
        //save result in model
        $smsModel->updateState($res, $apiNumber);
        return $res;
    }
}