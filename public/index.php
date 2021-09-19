<?php

use Dotenv\Dotenv;
use PhpMvc\Http\Request;
use PhpMvc\Http\Response;
use PhpMvc\Http\Route;

require_once __DIR__ . '/../src/Support/helpers.php';
require_once base_path() . '/vendor/autoload.php';
require_once base_path() . '/routes/web.php' ;

$env = Dotenv::createImmutable(base_path());
$env->load();

$route = new Route(new Request, new Response);
$route->resolve();

//app()->run();