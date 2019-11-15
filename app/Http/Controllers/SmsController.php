<?php

namespace App\Http\Controllers;



use App\Api;
use App\Sms as SmsModel;
use App\SmsFail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

/**
 * Class SmsController
 * @package App\Http\Controllers
 */
class SmsController extends Controller
{
    //

    public function showList(Request $request)
    {
        return view("/sms/frame");
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * show the report page
     */
    public function report(){
        //  retrieving data from cache. if it isn't available, it retrieves of database and store the result in the cache
        $reportValues = Cache::remember(Report_CACHE_KEY, CACHE_TTL, function () {
            return
                [
                    'topSenders' => SmsModel::topSenders(),
                    'smsTotal'  => SmsModel::countAll(),
                    'smsTotalApi1' => SmsModel::countAll(['api'=> API1_TITLE]),
                    'smsTotalApi2' => SmsModel::countAll(['api'=> API2_TITLE]),
                ];

        });

        return view("/sms/report",[
            'topSenders' => $reportValues['topSenders'],
            'smsTotal' => $reportValues['smsTotal'],
            'smsTotalApi1' => $reportValues['smsTotalApi1'],
            'smsTotalApi2' => $reportValues['smsTotalApi1'],
        ]);
    }
}



