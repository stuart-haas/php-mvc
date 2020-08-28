<?php

namespace app\web;

class Response {

    public static function instance() 
    {
        return new Response();
    }

    private function __construct()
    {
        
    }

    public function send($data)
    {
        ob_start();
        ob_clean();
        
        header_remove();
        header('Content-Type: application/json');

        echo json_encode($data);
    }
}