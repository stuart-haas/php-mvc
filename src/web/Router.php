<?php

namespace app\web;

use app\web\Url;
use app\controllers\BaseController;

class Router {

    private $url;
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

        if(is_null($this->url)) {
            $this->url = '';
        }

        if(empty($this->controller)) {
            $this->controller = 'default';
        }

        if(empty($this->action)) {
            $this->action = 'index';
        }
        
        $controller = ucfirst($this->controller) . 'Controller';

        if(file_exists(CONTROLLER_ROOT . DIRECTORY_SEPARATOR . $controller . '.php')) {
            $this->controller = $this->namespace.'\\'.$controller;
            if(class_exists($this->controller)) {
                    if(method_exists($this->controller, $this->action)) {
                        $controller = new $this->controller($this->url, $this->action);
                        $controller->runAction();
                    } else {
                        throw new \Exception("Method {$this->action} does not exist.");
                    }
            
            } else {
                throw new \Exception("Controller {$this->controller} not found.");
            }
        } else {
            throw new \Exception("Controller {$this->controller} not found.");
        }
    }
}