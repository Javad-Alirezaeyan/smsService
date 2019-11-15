<?php

namespace App\Jobs;



use App\classes\sms\SmsFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $smsModel;

    public function __construct($req)
    {
        //

        $this->smsModel = $req;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            SmsFacade::sendMessage($this->smsModel);
        }
        catch(\ErrorException $e){
            $this->smsModel(false);
        }

    }
}
