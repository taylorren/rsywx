<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\GuzzleService;

class MiscController extends AbstractController {

    private $service;

    public function __construct(GuzzleService $service) {
        $this->service = $service;
    }

    public function lakers()
    {
        $year=$_ENV['NBA_SEASON'];
        $span=$_ENV['NBA_SPAN'];
        $uri="misc/lakers/$year/$span";
        
        $res=json_decode((string)$this->service->getService()->get($uri)->getBody())->data;
        
        return $this->render('misc/lakers.html.twig', ['res'=>$res, 'year'=>$year]);
    }
}
