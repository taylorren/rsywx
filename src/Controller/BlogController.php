<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\GuzzleService;

class BlogController extends AbstractController {

    public function __construct() {
        
    }

    public function firstImg($uri) {
        $text=file_get_contents($uri);
        
        $matches=[];
        $img='';
        preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $text, $matches);
        $tmp=$matches[1];
        if(!empty($tmp))
        {
            $img=$matches[1][0];
        }
        else {
            $img="/img/default.jpg";
        }
        
        return $this->render('blog/first_image.html.twig', ['img' => $img]);
    }

}
