<?php

namespace App\Http\Controllers;


use App\classes\sms\SmsFacade;
use App\Http\Resources\SmsCollection;
use App\Jobs\SendSmsJob;
use App\Sms as SmsModel;
use App\Http\Resources\Sms as SmsResource ;
use App\SmsFail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


/**
 * Class ApiController
 * @package App\Http\Controllers
 * this controller handles all methods of The API for sms
 */
class ApiController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * This method is responsible to send sms. First it saves the sms in the DB. It face the input sms in two ways:
     * 1- Inserting in a Queue and sending the sms later
     * 2- Sending the sms immediately
     */
    public function sendSms(Request $request){

        // validation of input parameters
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:11',
            'body' => 'required|string|min:3',
        ]);
        if($validator->fails()){
            $errorMessages = [];
            foreach ($validator->errors()->getMessages() as $errMsg) {
                array_push($errorMessages, $errMsg);
            }
            return Response::json(['status'=>'error','message'=>['error'=>$errorMessages]], 300);
        }

        //saving the model
        $smsModel = New SmsModel();
        $smsModel->mobile = $request->mobile;
        $smsModel->body = $request->body;
        $smsModel->save();

        //sending sms
        if( env('USE_SMS_QUEUE', false)){
            // assign SmsModel to the sms job
            SendSmsJob::dispatch($smsModel)->delay(now()->addSecond(20));
            $smsModel->state = Queued_SMS;
            $smsModel->save();
        }
        else{
            //send the sms immediately
            SmsFacade::sendMessage($smsModel);
        }
        return response()->json(['status'=>'ok', 'id'=>$smsModel->id], 200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * this functions return the list of all sms
     */
    public function getSms(Request $request)
    {
        $page  = $request->input('page', 1);
        $count = $request->input('count', DefaultRowCount);
        $state = $request->input('state', null);
        $mobile = $request->input('mobile', "");
       // $deleted = $request->input('deleted', null);

        //find offset based on the page and count
        $offset = ($page-1) * $count;

        $where = [];
        if($state !== null){
            $where['state'] = $state;
            array_push($where, ['state', '=', $state]);
        }

        if($mobile !== ''){
            array_push($where, ['mobile', 'like', "%$mobile%"]);
        }


        $response =[
            'state' => 'ok',
            'data'=>[
                'page' => $page,
                'count' => $count,
                'all' => SmsModel::countAll($where),
                'list'=> new SmsCollection(SmsModel::getList($where, $offset, $count))
            ]

        ];

        return response()->json($response, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * this function returns the details of a sms
     */
    public function detailSms($id)
    {
        if (SmsModel::where('id', '=', $id)->exists()) {
            // sms was found
            $response =[
                'state' => 'ok',
                'detail'=>new SmsResource(SmsModel::find($id))
            ];
        }
        else{
            $response =[
                'state' => 'error',
                'message'=> 'Sms not found'
            ];
        }
        return response()->json($response, 200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * this method returns the count of failed sms by each API
     */
    public function failSmsApi(){

        //  retrieving data from cache. if it isn't available, it retrieves of database and store the result in the cache
        $chartData = Cache::remember(Percentage_FailApi_CACHE_KEY, CACHE_TTL, function () {
            return SmsFail::groupApi();
        });
        $response =[
            'state' => 'ok',
            'chartData'=> $chartData
        ];
        return response()->json($response, 200);
    }
}
