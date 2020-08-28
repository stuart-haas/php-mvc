<?php

namespace app\web;

use app\App;

class Response {

    public static function instance() 
    {
        return new Response();
    }

    private function __construct()
    {
        
    }

    public function sendJson($data)
    {
        ob_start();
        ob_clean();
        
        header_remove();
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function sendView($template, $data)
    {
        echo App::$template->render($template, $data);
    }
}