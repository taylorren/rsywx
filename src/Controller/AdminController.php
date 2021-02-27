<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\GuzzleService;

class AdminController extends AbstractController {

    private $service;

    public function __construct(GuzzleService $s) {
        $this->service = $s;
    }

    public function admin(){
        
        
        $visits=[
            '0101'=>123,
            '0102'=>345,
            '0103'=>789,
        ];
        
        return $this->render('admin/admin.html.twig', ['visits'=>$visits]);
    }
    
}
