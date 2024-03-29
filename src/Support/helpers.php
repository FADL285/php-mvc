<?php

use PhpMvc\Application;
use PhpMvc\View\View;

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? value($default);
    }
}

if (!function_exists('app')) {
    function app(): ?Application
    {
        static $instance = null;
        if (!$instance) {
            $instance = new Application;
        }
        return $instance;
    }
}

if (!function_exists('value')) {
    function value($value)
    {
        return ($value instanceof Closure) ? $value() : $value;
    }
}

if (!function_exists('base_path')) {
    function base_path($path = ''): string
    {
        return dirname(__DIR__) . '/../' . $path;
    }
}

if (!function_exists('view')) {
    function view($view, $params = []) {
        View::make($view, $params);
    }
}

if (!function_exists('config')) {
    function config($key = null, $default = null) {
        if (is_null($key)) {
            return app()->config;
        }

        if (is_array($key)) {
            app()->config->set($key);
            return app()->config;
        }

        return app()->config->get($key, $default);
    }
}