<?php

namespace app\controllers;

use app\App;

abstract class BaseController {

    protected $url;
    protected $action;

    public function __construct(string $url, string $action)
    {
        $this->url = $url;
        $this->action = $action;
    }

    public function runAction() 
    {
        if(!empty($this->action)) return $this->{$this->action}();
    }

    public function getJson($data) 
    {
        return App::$response->send($data);
    }

    public static function namespace() 
    {
        return __NAMESPACE__;
    }
}