<?php

use Dotenv\Dotenv;
use PhpMvc\Support\Arr;
use PhpMvc\Support\Config;

require_once __DIR__ . '/../src/Support/helpers.php';
require_once base_path() . '/vendor/autoload.php';
require_once base_path() . '/routes/web.php';

$env = Dotenv::createImmutable(base_path());
$env->load();

app()->run();

dump(config(['database.default' => 'sqlite']));