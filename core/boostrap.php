<?php

require_once __DIR__ . '/../app/routes.php';

class Bootstrap {

    public static function init() {
        Functions::env(__DIR__ . '/../.env');

        // Inicia la aplicación
        $router = new Router($_ENV['BASE_URL']);

        // Incluye las rutas
        global $route;
        foreach ($route as $uri => $controller) {
            $router->get($uri, $controller);
        }

        Router::init();
    }
}