<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\GuzzleService;

class BookController extends AbstractController {

    private $service;

    public function __construct(GuzzleService $service) {
        $this->service = $service;
    }

    public function detail($bookid): Response {
        $uri = "book/$bookid";
        $res = $this->service->getService()->get($uri);
        
        if($res->getStatusCode()== 404)//book not found
        {
            //TODO: redirec to a better looking "not found page"
            throw $this->createNotFoundException("Not found");
        }
        
        $book=json_decode((string)$res->getBody())->data;
        
        return $this->render('book/detail.html.twig', ['book' => $book]);
    }

    public function latestBook($max = 1): Response {
        $uri = "book/latest/$max";
        $res = json_decode((string) ($this->service->getService()->get($uri)->getBody()))->data[0];

        return $this->render('widget/default/latest_book.html.twig', ['res' => $res]);
    }

    public function randombook($max = 3): Response {
        $uri = "book/random/$max";
        $res = json_decode((string) ($this->service->getService()->get($uri)->getBody()))->data;

        return $this->render('widget/default/random_book.html.twig', ['res' => $res]);
    }

}
