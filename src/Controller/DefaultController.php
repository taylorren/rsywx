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
    
    public function latestBook($max=1):Response
    {
        $uri="book/latest/1";
        $res= json_decode((string)($this->service->getService()->get($uri)->getBody()))->data[0];
        
        $title=$res->title;
        $author=$res->author;
        $bookid=$res->bookid;
        
        $imguri="book/image/$bookid/$author/$title/600";
        $img= json_decode((string)($this->service->getService()->get($imguri)->getBody()))->data;
                
        return $this->render('widget/default/latest_book.html.twig', ['res'=>$res, 'img'=>$img]);
    }
}
