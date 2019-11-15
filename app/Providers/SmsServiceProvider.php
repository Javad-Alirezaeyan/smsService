<?php

namespace App\Providers;

use App\classes\sms\SmsApiHandler;
use App\classes\sms\SmsSender;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('smsHandler',function(){

            return new SmsApiHandler();

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
