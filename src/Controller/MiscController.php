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

    private function _getData($full) {
        $year = $_ENV['NBA_SEASON'];
        $span = $_ENV['NBA_SPAN'];
        $uri = "misc/lakers/$year/$span/$full";

        $res = json_decode((string) $this->service->getService()->get($uri)->getBody())->data;

        return [$res, $year];
    }

    public function lakers() {
        [$res, $year] = $this->_getData('true');
        return $this->render('misc/lakers.html.twig', ['res' => $res, 'year' => $year]);
    }

    public function lakers_summary() {
        [$res, $year] = $this->_getData('false');
        return $this->render('widget/default/lakers.html.twig', ['res' => $res, 'year' => $year]);
    }

    public function weather() {
        $uri = "misc/weather";
        $res = json_decode((string) $this->service->getService()->get($uri)->getBody())->data;
        return $this->render('widget/default/weather.html.twig', ['w' => $res]);
    }

    public function qotd() {
        $uri='misc/qotd';
        $res = json_decode((string) $this->service->getService()->get($uri)->getBody())->data;
        return $this->render('widget/default/qotd.html.twig', ['q'=>$res]);
    }

}
