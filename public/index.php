<?php

use Dotenv\Dotenv;
use PhpMvc\Support\Arr;
use PhpMvc\Support\Config;
use PhpMvc\Support\Hash;
use PhpMvc\Validation\Rules\AlphaNumericalRule;
use PhpMvc\Validation\Rules\RequiredRule;
use PhpMvc\Validation\Validator;

require_once __DIR__ . '/../src/Support/helpers.php';
require_once base_path('/vendor/autoload.php');
require_once base_path('/routes/web.php');

$env = Dotenv::createImmutable(base_path());
$env->load();

app()->run();

$validator = new Validator();

$validator->setRules([
    'username' => ['required', 'alnum']
]);

$validator->make([
    'username' => '$'
]);

dump($validator->errors());