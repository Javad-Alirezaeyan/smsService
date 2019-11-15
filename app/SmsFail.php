<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SmsFail extends Model
{
    //
    public $table = "sms_faillog";



    public static function groupApi(){
        return  DB::table('sms_faillog')
            ->select('api', DB::raw('count(*) as total'))
            ->groupBy('api')
            ->get();
    }

    public static function insert($api, $smsId){
        DB::table('sms_faillog')->insert(
            ['api' => $api, 'sms_id' => $smsId]
        );
    }

    public static function countAll($where=[]){
        return DB::table('sms_faillog')->where($where)
            ->where($where)->count();
    }
}
