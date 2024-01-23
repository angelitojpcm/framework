<?php
class Views {
    function render($controller, $view, $data = null){
        $controller = get_class($controller);
        $controller = str_replace('Controller', '', $controller);
        $view = __DIR__ . '/../app/views/' . $controller . '/' . $view . '.php';
        if(file_exists($view)){
            require $view;
        }else{
            echo 'Error: View not found';
        }
    }
}