<?php

namespace app;

use app\base\AppTrait;
use app\container\Container;
use app\container\JsonServiceFactory;
use app\web\Response;
use app\web\Router;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class App {

    use AppTrait;

    public static $instance;

    public static $container;

    public static $template;

    public static $response;

    public static $router;

    public function __construct()
    {
        self::$instance = $this;

        self::$container = Container::instance(new JsonServiceFactory(CONFIG_ROOT . DIRECTORY_SEPARATOR . 'services.json'));

        $loader = new FilesystemLoader(VIEW_ROOT);
        self::$template = new Environment($loader);

        self::$response = Response::instance();
        
        self::$router = Router::instance();
    }
}