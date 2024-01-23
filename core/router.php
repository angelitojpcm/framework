<?php
class Router {

    private $base_url ;

    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct($base_url = null) {
        $this->base_url = $base_url ?? $_ENV['BASE_URL'];
    }

    public function get($uri, $controller) {
        $uri = trim($uri, '/');
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $uri = trim($uri, '/');
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType) {
        $uri = trim($uri, '/');
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->routes[$requestType][$uri];
        }
        Logs::write('No se encontró la ruta: ' . $uri . ' - ' . $requestType);
        require_once __DIR__ . '/../app/views/errors/404.php';
        exit;
    }

    public static function init() {
        $router = new self();
        $uri = $_SERVER['REQUEST_URI'];
        $base_url_path = parse_url($router->base_url, PHP_URL_PATH);
        if ($base_url_path !== null && substr($uri, 0, strlen($base_url_path)) == $base_url_path) {
            $uri = substr($uri, strlen($base_url_path));
        }
        $uri = trim($uri, '/');
        $requestType = $_SERVER['REQUEST_METHOD'];
        $controller = $router->direct($uri, $requestType);
        $router->callAction(...explode('@', $controller));

    }

    protected function callAction($controller, $action) {
        $controller = new $controller;
        if (!method_exists($controller, $action)) {
            Logs::write("{$controller} no responde al método {$action}");
            require_once __DIR__ . '/../app/views/errors/404.php';
            exit;
        }
        $controller->$action();
    }

}