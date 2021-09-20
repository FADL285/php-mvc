<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/20/2021
 * Time: 3:26 PM
 */

namespace PhpMvc;

use JetBrains\PhpStorm\Pure;
use PhpMvc\Http\Request;
use PhpMvc\Http\Response;
use PhpMvc\Http\Route;

class Application {
    protected Route $route;
    protected Request $request;
    protected Response $response;

    #[Pure] public function __construct()
    {
        $this->request = new  Request();
        $this->response = new  Response();
        $this->route = new Route($this->request, $this->response);
    }

    public function run()
    {
        $this->route->resolve();
    }

    public function __get(string $name)
    {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
    }
}