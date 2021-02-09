<?php

namespace App\Service;

use GuzzleHttp\Client;

class GuzzleService {

    private $service;

    public function __construct() {
        $env=$_ENV['APP_ENV'];
        
        if ($env == 'prod') {
            $this->service = new Client([
                'base_uri' => 'https://api.rsywx.com/',
                //'http_errors' =>false,
            ]);
        }
        else
        {
            $this->service = new Client([
                'base_uri' => 'http://api/',
                //'http_errors'=>false,
            ]);
        }
    }

    public function getService(): Client {
        return $this->service;
    }

}
