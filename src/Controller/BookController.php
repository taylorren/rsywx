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
        try
        {
            $res = $this->service->getService()->get($uri);
        }
        catch (\GuzzleHttp\Exception\ClientException $e)
        {
            //TODO: redirec to a better looking "not found page"
            echo('error');die();
        }
        
        $book=json_decode((string)$res->getBody())->data;
        
        return $this->render('book/detail.html.twig', ['book' => $book]);
    }

    public function latestBook($max = 1): Response {
        $uri1 = "book/latest/$max"; //get the latest one book
        $uri2='book'; //get summary 
      
        //$book=json_decode((string)$this->service->getService()->get($uri1)->getBody())->data[0];
        //$summary=json_decode($this->service->getService()->get($uri2)->getBody())->data;
        
        $promises=[
            'book'=>$this->service->getService()->getAsync($uri1),
            'summary'=>$this->service->getService()->getAsync($uri2),
        ];
        
        $responses= \GuzzleHttp\Promise\Utils::unwrap($promises);
        $book=json_decode((string)$responses['book']->getBody())->data[0];
        $summary=json_decode((string)$responses['summary']->getBody())->data;
        return $this->render('widget/default/latest_book.html.twig', ['book' => $book, 'summary'=>$summary]);
    }

    public function randomBook($max = 3): Response {
        $uri = "book/random/$max";
        $book = json_decode((string) ($this->service->getService()->get($uri)->getBody()))->data;

        return $this->render('widget/default/random_book.html.twig', ['book' => $book[0]]);
    }
    
    public function list($type, $key, $page):Response
    {
        $uri="book/search/$type/$key/$page";
        $res= json_decode((string) ($this->service->getService()->get($uri)->getBody()))->data;
        
        return $this->render('book/list.html.twig', ['res'=>$res]);
    }
    
    public function search(\Symfony\Component\HttpFoundation\Request $req)
    {
        $key=$req->get("keyword");
        return $this->redirect($this->generateUrl("list", ['type'=>'various', 'key'=>$key, 'page'=>1]));
    }
    
    public function addTag(\Symfony\Component\HttpFoundation\Request $req)
    {
        $newtags=trim($req->get('newtags'));
        $id=$req->get('id');
        $bookid=$req->get('bookid');
        
        $uri="book/add_tag/$id/$newtags";
        
        
        //$data= json_encode(['tags'=>$newtags, 'id'=>$id]);

        $res=$this->service->getService()->get($uri);
        
        $uri=$this->generateUrl('detail', ['bookid'=>$bookid]);
        
        return $this->redirect($uri);
    }
    
    public function today()
    {
        $today=new \DateTime();
        $m=$today->format('m');
        $d=$today->format("d");
        $uri="book/today/$m/$d";
        
        $res=json_decode((string)($this->service->getService()->get($uri)->getBody()))->data;
        
        return $this->render("book/today.html.twig", ['books'=>$res->books, 'm'=>$m, 'd'=>$d]);
    }
}
