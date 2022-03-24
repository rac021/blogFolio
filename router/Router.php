<?php

namespace Router;

use App\Exceptions\NotFoundException;

class Router
{

    public $url;
    public $routes = [];

    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }

    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    public function post(string $path, string $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }

    public function run()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && !empty($_SERVER['REQUEST_METHOD'])) {
            $requestMethod = $requestMethod = $_SERVER['REQUEST_METHOD'];
        }
        foreach ($this->routes[$requestMethod] as $route) {
            if ($route->matches($this->url)) {
                return $route->execute();
            }
        }

        return;
    }
}
