<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/11/2021
 * Time: 3:47 PM
 */

namespace App\Controllers;

class HomeController {

    public function index()
    {
        view('home');
    }
}