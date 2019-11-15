<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sms extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $state = Config('constants.SmsState');

        return [
            'id' => $this->id,
            'mobile'=> $this->mobile,
            'body' =>$this->body,
            'api'=>   $this->api != "" ? "API ". $this->api : "",
            'createdDate'=> $this->created_at,
            'sendDate'=> $this->sent_at,
            'state' => $state[$this->state]
        ];

        //return parent::toArray($request);
    }
}
