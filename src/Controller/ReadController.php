<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\GuzzleService;

class ReadController extends AbstractController {

    private $service;

    public function __construct(GuzzleService $service) {
        $this->service = $service;
    }
    
    public function latest($max=1)
    {
        $readUri="read/latest/$max";
        $summaryUri='read';
        
        $promises=[
            'read'=>$this->service->getService()->getAsync($readUri),
            'summary'=>$this->service->getService()->getAsync($summaryUri),
        ];
        
        $responses= \GuzzleHttp\Promise\Utils::unwrap($promises);
        
        $read=json_decode((string)$responses['read']->getBody())->data[0];
        $summary=json_decode((string)$responses['summary']->getBody())->data;
        
        return $this->render('widget/default/latest_read.html.twig', ['read'=>$read, 'summary'=>$summary]);
    }
    
    public function search($page=1)
    {
        $uri="read/list/$page";
        $res=json_decode((string)$this->service->getService()->get($uri)->getBody())->data;
        
        return $this->render('read/list.html.twig', ['page'=>$page, 'res'=>$res]);
    }

}
