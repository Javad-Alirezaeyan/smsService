<?php

namespace App\Console\Commands;

use App\classes\sms\SmsFacade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'command:name';
    protected $signature = 'sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $listSms = DB::table('sms')->where(['state'=> UnSent_SMS])->all();
        foreach ($listSms as $smsModel){
            SmsFacade::sendMessage($smsModel);
        }
    }
}
