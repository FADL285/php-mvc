<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 9/14/2021
 * Time: 1:50 AM
 */

namespace PhpMvc\View;

class View {

    public static function make($view, $params = [])
    {
        $baseContent = self::getBaseContent();
        $viewContent = self::getViewContent($view, params: $params);

        echo str_replace('{{content}}', $viewContent, $baseContent);
    }

    public static function makeError(string $error)
    {
        self::getViewContent($error, true);
    }

    protected static function getBaseContent(): bool|string
    {
        ob_start();
        include base_path('/views/layouts/main.php');

        return ob_get_clean();
    }

    protected static function getViewContent($view, $isError = false, $params = [])
    {
        $path = $isError ? base_path('views/errors/') : base_path('views/');
        if (str_contains($view, '.')) {
            $views = explode('.', $view);
            foreach ($views as $view) {
                if (is_dir($path . $view)) {
                    $path = $path . $view . '/';
                }
            }

            $view = $path . end($views) . '.php';
        } else {
            $view = $path . $view . '.php';
        }

        foreach ($params as $param => $value) {
            $$param = $value;
        }

        if ($isError) {
            include $view;
        } else {
            ob_start();
            include $view;
            return ob_get_clean();
        }
    }
}