<?php

namespace App;

use App\classes\sms\InterfaceSmsInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sms extends Model implements InterfaceSmsInfo
{

    /**
     * @param array $state
     */
    public function updateState($state, $api = null){

        if($state){
            $this->state = Sent_SMS;
            $this->api = $api;
            $this->sent_at = Carbon::now();
        }
        else{
            $this->state = UnSent_SMS;
        }
        $this->save();
    }


    /**
     * @param $where
     * @param $offset
     * @param $count
     * @return \Illuminate\Support\Collection
     * this function returns the list of the sms
     */
    public static function getList($where, $offset = 0 , $count = DefaultRowCount)
    {
        return  DB::table('sms')
            ->where($where)->offset($offset)->limit($count)->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param array $where
     * @return int
     * this function returns the count of the sms
     */
    public static function countAll($where=[]){
        return DB::table('sms')->where($where)
            ->where($where)->count();
    }


    /**
     * @param int $count
     * @return \Illuminate\Support\Collection
     * this function returns the top senders that have sent the most sms
     */
    public static function topSenders($count = 10){
        return  DB::table('sms')
            ->select('mobile', DB::raw('count(*) as total'))
            ->groupBy('mobile')->orderBy("total", 'DESC') ->limit($count)
            ->get();
    }
}
