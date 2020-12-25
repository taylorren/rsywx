<?php

namespace App\Service;

use GuzzleHttp\Client;

class GuzzleService
{
    private $service;
    
    public function __construct()
    {
        $this->service=new Client([
            'base_uri' => 'http://api/',
        ]);
    }
    
    public function getService()
    {
        return $this->service;
    }
}