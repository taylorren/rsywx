<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\GuzzleService;

class DefaultController extends AbstractController
{
    private $service;
    
    public function __construct(GuzzleService $service)
    {
        $this->service=$service;
    }
        

    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }
    
    public function about(): Response 
    {
        return $this->render('default/aboutus.html.twig');
    }
    
    public function careers():Response
    {
        return $this->render('default/careers.html.twig');
    }
    
    public function contact():Response
    {
        return $this->render('default/contact.html.twig');
    }
    
}
