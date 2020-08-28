<?php

namespace app;

use app\base\AppTrait;
use app\container\Container;
use app\container\JsonServiceFactory;
use app\web\Response;
use app\web\Router;

class App {

    use AppTrait;

    public static $instance;

    public static $container;

    public static $router;

    public static $response;

    public function __construct()
    {
        self::$instance = $this;

        self::$container = Container::instance(new JsonServiceFactory(constant('CONFIG_ROOT').'/services.json'));

        self::$response = Response::instance();
        
        self::$router = Router::instance();
    }
}