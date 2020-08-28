<?php

namespace app;

use app\container\Container;
use app\container\JsonServiceFactory;
use app\web\Response;
use app\web\Router;

class App {

    public static $container;

    public static $router;

    public static $response;

    public function __construct()
    {
        static::$container = Container::instance(new JsonServiceFactory(constant('CONFIG_ROOT').'/services.json'));

        static::$response = Response::instance();
        
        static::$router = Router::instance();
    }
}