<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class WppConnectionApi
{
    protected $url;
    protected $domain;

    public function __construct($url, $domain)
    {
        $this->url = $url;
        $this->domain = $domain;
    }

    public function notification($phone, $message)
    {
        $body = [
            "phone" => $phone,
            "isGroup" => false,
            "isNewsletter" =>  false,
            "message" => $message
        ];

        $response = Http::withHeaders(['Authorization' => "Bearer " . config('services.wppconnect.token')])
            ->withBody(json_encode($body), 'application/json')
            ->post($this->url . '/api/' . $this->domain . '/send-message');

        return $response->object();
    }
}
