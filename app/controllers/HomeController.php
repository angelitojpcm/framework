<?php 

class HomeController extends Controllers {

    function index() {
        $data = [
            'title' => 'Home',
            'message' => 'Bienvenido a mi sitio web'
        ];

        $this->views->render($this, 'index', $data);
    }
}