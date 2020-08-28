<?php

namespace app\controllers;

use app\App;
use app\services\ApiService;

class DefaultController extends BaseController {

    public function __construct(string $url, string $action)
    {
        parent::__construct($url, $action);
    }

    public function index() 
    {
        $data = App::$instance->api()->getData();

        return $this->getJson($data);
    }
}