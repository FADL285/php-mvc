<?php

namespace PhpMvc\Http;

class Route {

    public static array $routes = [];

    public function __construct(protected Request $request, protected Response $response)
    {

    }

    public static function get($route, callable|array $action)
    {
        self::$routes['get'][$route] = $action;
    }

    public static function post($route, callable|array $action)
    {
        self::$routes['post'][$route] = $action;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $action = self::$routes[$method][$path] ?? false;

        if (!$action) {
            return;
        }

        // 404 handling

        // callback
        if (is_callable($action)) {
            call_user_func_array($action, []);
        }
        // array
        elseif (is_array($action)) {
            call_user_func_array([new $action[0], $action[1]], []);
        }
    }
}