<?php

namespace app\base;

use app\App;

trait AppTrait {

    public function api()
    {
        return App::$container->get('apiService');
    }
}