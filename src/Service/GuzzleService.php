<?php

namespace App\Service;

use GuzzleHttp\Client;

class GuzzleService
{
    private $service;
    
    public function __construct()
    {
        $this->service=new Client([
            'base_uri' => 'https://api.rsywx.com/',
        ]);
    }
    
    public function getService()
    {
        return $this->service;
    }
}
