<?php

namespace app\web;

class Url {

    public static function path()
    {
        if(!empty($_SERVER)) {
            return $_SERVER['PATH_INFO'];
        }
    }

    public static function segments(int $index)
    {
        $segments = explode('/', ltrim(Url::path()));
        if(isset($index)) {
            return $segments[$index];
        }
        return $segments;
    }
}