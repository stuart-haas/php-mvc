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
        extract($data);
        
        ob_start();

        header_remove();
        header('Content-Type: text/html');

        include(VIEW_ROOT . DIRECTORY_SEPARATOR . $template . '.html');
        
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }
}