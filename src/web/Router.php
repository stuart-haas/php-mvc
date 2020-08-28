<?php

namespace app\web;

use app\web\Url;
use app\controllers\BaseController;

class Router {

    private $url;
    private $controllers;
    private $controller;
    private $namespace;
    private $action;

    public static function instance() {
        return new Router();
    }

    private function __construct()
    {
        $this->mapController();
    }

    private function mapController() 
    {
        $this->namespace = BaseController::namespace();

        $this->controllers = [];

        $this->url = Url::path();
        $this->controller = Url::segments(1);
        $this->action = Url::segments(2);

        if(empty($this->controller)) {
            $this->controller = 'default';
        }

        if(empty($this->action)) {
            $this->action = 'index';
        }
        
        $files = scandir(constant('CONTROLLER_ROOT'));
        $files = array_diff($files, array('.', '..'));
        foreach($files as $filename) {
            $controller = basename($filename, '.php');
            $this->controllers[] = $controller;
        }

        $this->createController();
    }

    private function createController()
    {
        $controller = ucfirst($this->controller) . 'Controller';
        $this->controller = $this->namespace.'\\'.$controller;
        if(class_exists($this->controller)) {
            if(in_array($controller, $this->controllers)) {
                if(method_exists($this->controller, $this->action)) {
                    $controller = new $this->controller($this->url, $this->action);
                    $controller->runAction();
                } else {
                    throw new \Exception("Method {$this->action} does not exist.");
                }
            }
        } else {
            throw new \Exception("Controller {$this->controller} not found.");
        }
    }
}