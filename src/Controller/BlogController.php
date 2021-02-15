<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\GuzzleService;

class BlogController extends AbstractController {

    private $service;

    public function __construct(GuzzleService $s) {
        $this->service = $s;
    }

    public function firstImg($text) {
        $matches = [];
        $img = '';
        preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $text, $matches);
        $tmp = $matches[1];
        if (!empty($tmp)) {
            $img = $matches[1][0];
        } else {
            $img = "/img/default.jpg";
        }

        return $img;
    }

    public function latest($max = 1) {
        $uri = "blog/latest/$max";

        $res = json_decode((string) ($this->service->getService()->get($uri)->getBody()))->data[0];
        $img = $this->firstImg($res->content->rendered);

        return $this->render('widget/default/latest_blog.html.twig', ['res' => $res, 'img' => $img]);
    }

    public function today() {
        $uri='blog/today';
        $res=json_decode((string) ($this->service->getService()->get($uri)->getBody()))->data;
                
        return $this->render('widget/default/blog_today.html.twig', ['res'=>$res]);
    }

}
