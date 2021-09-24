<?php

use Dotenv\Dotenv;
use PhpMvc\Support\Arr;

require_once __DIR__ . '/../src/Support/helpers.php';
require_once base_path() . '/vendor/autoload.php';
require_once base_path() . '/routes/web.php';

$env = Dotenv::createImmutable(base_path());
$env->load();

app()->run();
$tes_arr = ['username' => 'fadl', 'email' => ['personal' => 'fadl@mail.com', 'work' => 'fadl@spider.com'], 'age' => 21];
//dump(Arr::flatten([[1],[2], [[2,7]], [[[[4, 5]]]]]));
//dump(Arr::get($tes_arr, 'email'));
//dump(Arr::has($tes_arr, 'email.personal'));
//dump(Arr::accessible($tes_arr));

dump($tes_arr);
Arr::set($tes_arr, 'email.personal', 'fadl@gmail.co');
dump($tes_arr);
Arr::set($tes_arr, 'email.home', 'fadl@home.me');
dump($tes_arr);
Arr::unset($tes_arr, 'email.home');
dump($tes_arr);
