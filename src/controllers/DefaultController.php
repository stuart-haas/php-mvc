<?php

namespace app\controllers;

use app\App;

class DefaultController extends BaseController {

    public function index() 
    {
        $data = App::$instance->api()->getData();

        return $this->getJson($data);
    }

    public function view()
    {
        return $this->renderView('index.twig', ['title' => 'Hello World!']);
    }
}