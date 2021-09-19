<?php

use App\Controllers\HomeController;
use PhpMvc\Http\Route;

//Route::get('/', function (){
//    echo "Hello";
//});

Route::get('/', [HomeController::class, 'index']);